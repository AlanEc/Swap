<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 14/01/2019
 * Time: 09:25
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Booking;
use App\Entity\SwapService;
use App\Entity\BookingState;
use App\Entity\BookingType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Cookie;
use App\Form\BookingFormType;
use App\Service\BookingManager;
use App\Service\TransactionManager;

class BookingController extends AbstractController
{
    protected $bookingManager;
    protected $transactionManager;

    public function __construct(BookingManager $bookingManager, TransactionManager $transactionManager)
    {
        $this->bookingManager = $bookingManager;
        $this->transactionManager = $transactionManager;
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("search/booking/new/{swapId}", name="swap_booking_new")
     */
    public function new(Request $request, $swapId)
    {
        $repository = $this->getDoctrine()->getRepository(Booking::class);
        $bookingsList = $repository->findBy(['swapService' => $swapId]);
        $repository = $this->getDoctrine()->getRepository(SwapService::class);
        $swap = $repository->findOneBy(['id' => $swapId]);

        $array = $this->bookingManager->createArrayDateBooked($bookingsList);
        $form = $this->createForm(BookingFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();
            $checkAlreadyBooked = $this->bookingManager->checkAlreadyBooked($booking, $bookingsList);
            if ($checkAlreadyBooked == true) {
                $this->addFlash('error', 'Ces dates sont déjà prises !');
                return $this->redirect($this->generateUrl('swap_booking_new', array('swapId' => $swapId)));
            }
            $totalAmount = $this->transactionManager->calculTotalAmount($booking, $swap);
            $checkAccount = $this->transactionManager->checkAccount($totalAmount);
            if ($checkAccount == true ) {
                $transaction = $this->transactionManager->new($swap, $totalAmount);
                $swapService = $this->bookingManager->createBooking($booking, $swap, $transaction);
                $this->addFlash('success', 'Réservation effectué');
            } else {
                $this->addFlash('success', 'Vous ne disposez pas de suffisamment de Swap');
            }
            return $this->redirectToRoute('app_account');
        }

        return $this->render('core/swapService/booking.html.twig', [
            'form' => $form->createView(),
            'dateBooked' => json_encode($array),
            'swapId' => $swapId,
            'amount' => json_encode($swap->getSwapServiceType()->getValueScale()),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("search/booking/accepted/{bookingId}", name="swap_booking_accepted")
     */
    public function accepted(Request $request, $bookingId)
    {
        $state = $this->bookingManager->getAcceptedState();
        $repository = $this->getDoctrine()->getRepository(Booking::class);
        $booking = $repository->findOneBy(['id' => $bookingId]);
        $this->transactionManager->credit($booking);
        $booking->setBookingState($state);
        $em = $this->getDoctrine()->getManager();
        $em->persist($booking);
        $em->flush();

        $this->addFlash('success', 'Swap validé !');
        return $this->redirectToRoute('app_account');
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("search/booking/canceled/{bookingId}", name="swap_booking_canceled")
     */
    public function canceled(Request $request, $bookingId){
        $state = $this->bookingManager->getCanceledState();

        $repository = $this->getDoctrine()->getRepository(Booking::class);
        $booking = $repository->findOneBy(['id' => $bookingId]);

        $bookingState = $booking->getBookingState();
        $this->transactionManager->canceled($booking, $bookingState);

        $booking->setBookingState($state);
        $em = $this->getDoctrine()->getManager();
        $em->persist($booking);
        $em->flush();

        $this->addFlash('success', 'Swap refusé !');
        return $this->redirectToRoute('app_account');
    }
}
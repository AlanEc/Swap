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
    /**
     * @IsGranted("ROLE_USER")
     * @Route("search/booking/new/{swapId}", name="swap_booking_new")
     */
    public function new(Request $request, $swapId, BookingManager $bookingManager, TransactionManager $transactionManagert)
    {
        $repository = $this->getDoctrine()->getRepository(Booking::class);
        $bookingsList = $repository->findBy(['swapService' => $swapId]);
        $repository = $this->getDoctrine()->getRepository(SwapService::class);
        $swap = $repository->findOneBy(['id' => $swapId]);

        $amount = $swap->getSwapServiceType()->getValueScale();

        $array = $bookingManager->createArrayDateBooked($bookingsList);

        $form = $this->createForm(BookingFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();

            $transaction = $transactionManagert->new($swapId, $booking);
            if ($transaction == true ) {
                $swapService = $bookingManager->createBooking($booking, $swapId);
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
            'amount' => json_encode($amount),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("search/booking/accepted/{swapId}", name="swap_booking_accepted")
     */
    public function accepted(Request $request)
    {

    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("search/booking/canceled/{swapId}", name="swap_booking_canceled")
     */
    public function canceled(Request $request)
    {

    }
}
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
use App\Form\BookingFormType;


class BookingController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/booking", name="swap_booking")
     */
    public function index(Request $request)
    {
        return $this->render('core/swapService/booking.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/booking/new/{swapId}", name="swap_booking_new")
     */
    public function new(Request $request, $swapId)
    {
        $form = $this->createForm(BookingFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking  = $form->getData();
            $booking->setDisabled(0);

            $repository = $this->getDoctrine()->getRepository(SwapService::class);
            $swap = $repository->findOneBy(['id' => $swapId]);

            $repository = $this->getDoctrine()->getRepository(BookingState::class);
            $bookingState = $repository->findOneBy(['id' => 92]);

            $repository = $this->getDoctrine()->getRepository(BookingType::class);
            $bookingType = $repository->findOneBy(['id' => 48]);

            $user = $this->getUser();

            $booking->setBookingType($bookingType);
            $booking->setBookingState($bookingState);
            $booking->setUser($user);
            $booking->setSwapService($swap);
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();
        }

        return $this->render('core/swapService/booking.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
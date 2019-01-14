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
use App\Service\BookingManager;

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
    public function new(Request $request, $swapId, BookingManager $bookingManager)
    {
        $form = $this->createForm(BookingFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking  = $form->getData();
            $swapService = $bookingManager->createBooking($booking, $swapId);

            $this->addFlash('success', 'Article Created! Knowledge is power!');
            return $this->redirectToRoute('app_account');
        }

        return $this->render('core/swapService/booking.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
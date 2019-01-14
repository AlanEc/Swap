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
     * @Route("/booking/new", name="swap_booking_new")
     */
    public function new(Request $request)
    {
        $form = $this->createForm(BookingFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('core/swapService/booking.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
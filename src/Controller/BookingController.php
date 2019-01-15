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

class BookingController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/booking/new/{swapId}", name="swap_booking_new")
     */
    public function new(Request $request, $swapId, BookingManager $bookingManager)
    {
        $repository = $this->getDoctrine()->getRepository(Booking::class);
        $bookingsList = $repository->findBy(['swapService' => $swapId]);


        $array = [];

        $userArray = array(
            array('name'=>'John Doe', 'email'=>'john@example.com'),
            array('name'=>'Marry Moe', 'email'=>'marry@example.com'),
            array('name'=>'Smith Watson', 'email'=>'smith@example.com')
        );

         foreach($bookingsList as $key => $booked)
        {
            $datetime = $booked->getDateStart();

            $array[$key]['dateStart']['day'] =  trim($datetime->format('d'), 0);
            $array[$key]['dateStart']['month'] = trim($datetime->format('m'), 0);
            $array[$key]['dateStart']['year'] = trim($datetime->format('y'), 0);

            $datetime = $booked->getDateEnd();
            $array[$key]['dateEnd']['day'] = trim($datetime->format('d'), 0);
            $array[$key]['dateEnd']['month'] = trim($datetime->format('m'), 0);
            $array[$key]['dateEnd']['year'] = trim($datetime->format('y'), 0);
        }

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
            'dateBooked' => json_encode($array),
            'userArray' => json_encode($userArray),
        ]);
    }
}
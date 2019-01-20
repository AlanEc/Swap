<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 14/01/2019
 * Time: 15:25
 */

namespace App\Service;

use App\Entity\SwapService;
use App\Entity\BookingType;
use App\Entity\BookingState;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

class BookingManager extends AbstractController
{
      public function createBooking(object $booking, object $swap, object $transaction): string
    {
        $booking->setDisabled(0);

        $repository = $this->getDoctrine()->getRepository(BookingState::class);
        $bookingState = $repository->findOneBy(['id' => 92]);

        $repository = $this->getDoctrine()->getRepository(BookingType::class);
        $bookingType = $repository->findOneBy(['id' => 48]);

        $user = $this->getUser();

        $booking->setBookingType($bookingType);
        $booking->setBookingState($bookingState);
        $booking->setUser($this->getUser());
        $booking->setTransaction($transaction);
        $booking->setSwapService($swap);
        $em = $this->getDoctrine()->getManager();
        $em->persist($booking);
        $em->flush();

        return true;
    }

    public function createArrayDateBooked(array $bookingsList): array
    {
        $array = array();

        foreach($bookingsList as $key => $booked)
        {
            $datetime = $booked->getDateStart();

            $array[$key]['dateStart']['day'] =  $datetime->format('d');
            $array[$key]['dateStart']['month'] = $datetime->format('m');
            $array[$key]['dateStart']['year'] = $datetime->format('y');

            $datetime = $booked->getDateEnd();
            $array[$key]['dateEnd']['day'] = $datetime->format('d');
            $array[$key]['dateEnd']['month'] = $datetime->format('m');
            $array[$key]['dateEnd']['year'] = $datetime->format('y');
        }

        return $array;
    }

    public function getAcceptedState()
    {
        $repository = $this->getDoctrine()->getRepository(BookingState::class);
        $bookingState = $repository->findOneBy(['id' => 90]);

        return $bookingState;
    }

    public function getCanceledState()
    {
        $repository = $this->getDoctrine()->getRepository(BookingState::class);
        $bookingState = $repository->findOneBy(['id' => 91]);

        return $bookingState;
    }

    public function getDoneState()
    {
        $repository = $this->getDoctrine()->getRepository(BookingState::class);
        $bookingState = $repository->findOneBy(['id' => 89]);

        return $bookingState;
    }
}
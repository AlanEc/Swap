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

class BookingManager extends AbstractController
{
    public function createBooking(object $booking, int $swapId): string
    {
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

        return 'success';
    }

}
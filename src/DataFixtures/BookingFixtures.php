<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BookingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $repository = $manager->getRepository(BookingType::class);
        $bookingType = $repository->findOneBy(['label' => 'Hebergement']);

        $repository = $manager->getRepository(SwapService::class);
        $swapService = $repository->findOneBy(['disabled' => 1]);

        $repository = $manager->getRepository(User::class);
        $user = $repository->findOneBy(['email' => 'test0@example.com']);

        $repository = $manager->getRepository(BookingState::class);
        $bookingState = $repository->findOneBy(['label' => 'Hebergement']);

        $booking = new booking();
        $booking->setDateStart(new \DateTime());
        $booking->setDateEnd(new \DateTime("+ 2 days"));
        $booking->setBookingType($bookingType);
        $booking->setBookingState($bookingState);
        $booking->setCreatedAt(new \DateTime());
        $booking->setUpdatedAt(new \DateTime());
        $booking->setDisabled(0);

        $manager->persist($booking);

        $manager->flush();
    }
}

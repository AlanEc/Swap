<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Booking;

class BookingFixtures extends Fixture  implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $booking = new booking();
        $booking->setDateStart(new \DateTime());
        $booking->setDateEnd(new \DateTime("+ 2 days"));
        $booking->setBookingSate($this->getReference('booking-waiting'));
        $booking->setBookingType($this->getReference('booking-manual'));
        $booking->setSwapService($this->getReference('swapService-Montpellier'));
        $booking->setUser($this->getReference('booking-user'));
        $booking->setCreatedAt(new \DateTime());
        $booking->setUpdatedAt(new \DateTime());
        $booking->setDisabled(0);

        $manager->persist($booking);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4; // number in which order to load fixtures
    }
}

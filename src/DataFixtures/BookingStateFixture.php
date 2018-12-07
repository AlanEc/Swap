<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BookingStateFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $bookingState1 = new BookingState();
        $bookingState1->setLabel('Done');
        $bookingState1->setCreatedAt(new \DateTime());
        $bookingState1->setUpdatedAt(new \DateTime());
        $bookingState1->setDisabled(0);

        $manager->persist($bookingState1);

        $bookingState2 = new BookingState();
        $bookingState2->setLabel('Accepted');
        $bookingState2->setCreatedAt(new \DateTime());
        $bookingState2->setUpdatedAt(new \DateTime());
        $bookingState2->setDisabled(0);

        $manager->persist($bookingState2);

        $bookingState3 = new BookingState();
        $bookingState3->setLabel('Canceled');
        $bookingState3->setCreatedAt(new \DateTime());
        $bookingState3->setUpdatedAt(new \DateTime());
        $bookingState3->setDisabled(0);

        $manager->persist($bookingState3);

        $bookingState4 = new BookingState();
        $bookingState4->setLabel('Waiting');
        $bookingState4->setCreatedAt(new \DateTime());
        $bookingState4->setUpdatedAt(new \DateTime());
        $bookingState4->setDisabled(0);

        $manager->persist($bookingState4);

        $manager->flush()
    }
}

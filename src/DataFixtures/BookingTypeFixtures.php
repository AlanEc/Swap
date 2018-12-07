<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BookingTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $bookingType1 = new BookingType
        $bookingType1->setLabel('Automatic');
        $bookingType1->setCreatedAt(new \DateTime());
        $bookingType1->setUpdatedAt(new \DateTime());
        $bookingType1->setDisabled(0);

        $manager->persist($bookingType1);

        $bookingType2 = new BookingType();
        $bookingType2->setLabel('Manual');
        $bookingType2->setCreatedAt(new \DateTime());
        $bookingType2->setUpdatedAt(new \DateTime());
        $bookingType2->setDisabled(0);

        $manager->persist($bookingType2);

        $manager->flush();
    }
}

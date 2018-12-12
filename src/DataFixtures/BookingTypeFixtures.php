<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\BookingType;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BookingTypeFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $bookingType1 = new BookingType;
        $bookingType1->setLabel('Automatic');
        $bookingType1->setCreatedAt(new \DateTime());
        $bookingType1->setUpdatedAt(new \DateTime());
        $bookingType1->setDisabled(0);

        $this->addReference('booking-automatic', $bookingType1);
        $manager->persist($bookingType1);

        $bookingType2 = new BookingType();
        $bookingType2->setLabel('Manual');
        $bookingType2->setCreatedAt(new \DateTime());
        $bookingType2->setUpdatedAt(new \DateTime());
        $bookingType2->setDisabled(0);

        $this->addReference('booking-manual', $bookingType2);
        $manager->persist($bookingType2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2; // number in which order to load fixtures
    }
}

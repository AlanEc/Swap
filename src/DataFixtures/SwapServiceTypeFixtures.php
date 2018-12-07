<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\SwapServiceType;

class SwapServiceTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $swapServiceType = new SwapServiceType();
        $swapServiceType->setLabel('Hebergement');
        $swapServiceType->setValueScale(10);
        $swapServiceType->setCreatedAt(new \DateTime());
        $swapServiceType->setUpdatedAt(new \DateTime());
        $swapServiceType->setDisabled(0);

        $manager->persist($swapServiceType);
        $manager->flush();
    }
}

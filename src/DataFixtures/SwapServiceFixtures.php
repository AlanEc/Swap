<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\SwapService;
use Doctrine\Common\Persistence\ObjectManager;

class SwapServiceFixtures extends Fixture  implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $swapService = new SwapService();
        $swapService->setQuantity(1);
        $swapService->setPeopleQuantity(1);
        $swapService->setLatitude(47.218371);
        $swapService->setLongitude(-1.553621);
        $swapService->setAdress1('26 rue Lakanal');
        $swapService->setCity('Montpellier');
        $swapService->setPostalCode(44000);
        $swapService->setRegion('Pays de la loire');
        $swapService->setCountry('France');
        $swapService->setUser($this->getReference('SwapService-user'));
        $swapService->setSwapServiceType($this->getReference('swapServiceType-accommodation'));
        $swapService->setCreatedAt(new \DateTime());
        $swapService->setUpdatedAt(new \DateTime());
        $swapService->setDisabled(0);

        $this->addReference('swapService-Montpellier', $swapService);
        $manager->persist($swapService);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3; // number in which order to load fixtures
    }
}

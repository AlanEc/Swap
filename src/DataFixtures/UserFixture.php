<?php

namespace App\DataFixtures;

use App\Entity\SwapService;
use App\Entity\SwapServiceType;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class UserFixture extends BaseFixture
{
	protected $faker;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
    		$user = new User();
    		$user->setEmail(sprintf('test%d@example.com', $i));
    		$user->setFirstName($this->faker->firstName);
    		$user->setLastName($this->faker->lastName);
    		$user->setPhone($this->faker->phoneNumber);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));
    		$user->setAccount(0);
    		$user->setDisabled(0);
    		$user->setCreatedAt(new \DateTime());
    		$user->setUpdatedAt(new \DateTime());

            $repository = $manager->getRepository(SwapServiceType::class);
            $swapServiceType = $repository->findOneBy(['label' => 'Hebergement']);

            $swapService = new SwapService();
            $swapService->setQuantity(1);
            $swapService->setPeopleQuantity(1);
            $swapService->setLatitude(47.218371);
            $swapService->setLongitude(-1.553621);
            $swapService->setAdress1('26 rue Lakanal');
            $swapService->setCity('Nantes');
            $swapService->setPostalCode(44000);
            $swapService->setRegion('Pays de la loire');
            $swapService->setCountry('France');
            $swapService->setUser($user);
            $swapService->setSwapServiceType($swapServiceType);
            $swapService->setCreatedAt(new \DateTime());
            $swapService->setUpdatedAt(new \DateTime());
            $swapService->setDisabled(0);

    		$manager->persist($swapService);
    	}

        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setEmail(sprintf('admin%d@example.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);
            $user->setPhone($this->faker->phoneNumber);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));
            $user->setRoles(['ROLE_ADMIN']);
            $user->setAccount(0);
            $user->setDisabled(0);
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());
            $user->setDisabled(0);
            $manager->persist($user);
        }

        $manager->flush();
    }
}

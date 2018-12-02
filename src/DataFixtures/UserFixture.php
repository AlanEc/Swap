<?php

namespace App\DataFixtures;

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
    		$user->setUptadedAt(new \DateTime());

    		$manager->persist($user);
    	}

        $manager->flush();
    }
}

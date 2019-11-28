<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;
use Ottaviano;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    const DEFAULT_USERS = [
        [
            'firstName' => 'user',
            'lastName' => 'User',
            'email' => 'user@projet.io',
            'telephone' => '0606060606',
            'role' => 0
        ],
        [
            'firstName' => 'admin',
            'lastName' => 'Admin',
            'email' => 'admin@projet.io',
            'telephone' => '0606060606',
            'role' => 1
        ],
        [
            'firstName' => 'superadmin',
            'lastName' => 'SuperAdmin',
            'email' => 'superadmin@projet.io',
            'telephone' => '0606060606',
            'role' => 2
        ],
    ];

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $passwordDefault = 'ogong';
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new Ottaviano\Faker\Gravatar($faker));

        for ($nUserDefault = 0; $nUserDefault < count(self::DEFAULT_USERS); $nUserDefault++) {
            $userDefault = new User();
            $userDefault->setFirstName(self::DEFAULT_USERS[$nUserDefault]['firstName']);
            $userDefault->setLastName(self::DEFAULT_USERS[$nUserDefault]['lastName']);
            $userDefault->setEmail(self::DEFAULT_USERS[$nUserDefault]['email']);
            $userDefault->setTelephone(self::DEFAULT_USERS[$nUserDefault]['telephone']);
            $userDefault->setRole($this->getReference('role' . self::DEFAULT_USERS[$nUserDefault]['role']));
            $userDefault->setCreatedAt($faker->dateTimeThisMonth('now', 'Europe/Paris'));
            $password = $this->encoder->encodePassword($userDefault, $passwordDefault);
            $userDefault->setPassword($password);
            $manager->persist($userDefault);
        }

        //Owner Users
        for ($nOwner = 0; $nOwner < CompanyFixtures::COUNT_COMPANY; $nOwner++) {
            $owner = new User();
            $owner->setFirstName($faker->firstName);
            $owner->setLastName($faker->lastName);
            $owner->setEmail($faker->email);
            $owner->setTelephone($faker->phoneNumber);
            $faker->boolean(70) ? $owner->setPhoto($faker->gravatarUrl()) : null;
            $owner->setRole($this->getReference('role1'));
            $owner->setCreatedAt($faker->dateTimeThisYear('now', 'Europe/Paris'));
            $password = $this->encoder->encodePassword($owner, $passwordDefault);
            $owner->setPassword($password);
            $owner->setCompany($this->getReference('company' . $nOwner));
            $manager->persist($owner);
            $company = $this->getReference('company' . $nOwner);
            $company->setOwner($owner);
            $manager->persist($company);
        }

        //Extra Users
        $countUser = 200;
        for ($nUser = 0; $nUser < $countUser; $nUser++) {
            $user = new User();
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setEmail($faker->email);
            $user->setTelephone($faker->phoneNumber);
            $faker->boolean(70) ? $user->setPhoto($faker->gravatarUrl()) : null;
            //Default ROLE_USER
            $user->setRole($this->getReference('role' . $faker->numberBetween(0, count(RoleFixtures::ROLES) - 2)));
            $user->setCreatedAt($faker->dateTimeThisYear('now', 'Europe/Paris'));
            $password = $this->encoder->encodePassword($user, $passwordDefault);
            $user->setPassword($password);
            $user->setCompany(
                $this->getReference(
                    'company' . $faker->numberBetween(0, CompanyFixtures::COUNT_COMPANY - 1)
                )
            );
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CompanyFixtures::class,
            RoleFixtures::class,
        );
    }
}

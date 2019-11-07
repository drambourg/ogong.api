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
    const ROLES = [
        'ROLE_USER',
        'ROLE_ADMIN',
        'ROLE_SUPERADMIN'
    ];

    const DEFAULT_USERS = [
        [
            'firstName' => 'user',
            'lastName' => 'User',
            'email' => 'user@projet.io',
            'telephone' => '0606060606',
            'roles' => ['ROLE_USER']
        ],
        [
            'firstName' => 'admin',
            'lastName' => 'Admin',
            'email' => 'admin@projet.io',
            'telephone' => '0606060606',
            'roles' => ['ROLE_ADMIN']
        ],
        [
            'firstName' => 'superadmin',
            'lastName' => 'SuperAdmin',
            'email' => 'superadmin@projet.io',
            'telephone' => '0606060606',
            'roles' => ['ROLE_USER']
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
            $userDefault->setRoles(self::DEFAULT_USERS[$nUserDefault]['roles']);
            $userDefault->setCreatedAt($faker->dateTimeThisMonth('now', 'Europe/Paris'));
            $password = $this->encoder->encodePassword($userDefault, $passwordDefault);
            $userDefault->setPassword($password);
            $manager->persist($userDefault);
        }

        //Extra Users
        $countUser = 36;
        for ($nUser = 0; $nUser < $countUser; $nUser++) {
            $user = new User();
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setEmail($faker->email);
            $user->setTelephone($faker->phoneNumber);
            $faker->boolean(70) ? $user->setPhoto($faker->gravatarUrl()) : null;
            $user->setRoles([self::ROLES[$faker->numberBetween(0, count(self::ROLES) - 1)]]);
            $user->setCreatedAt($faker->dateTimeThisYear('now', 'Europe/Paris'));
            $password = $this->encoder->encodePassword($user, $passwordDefault);
            $user->setPassword($password);
            $faker->boolean(70) ? $user->setCompany(
                $this->getReference(
                    'company' . $faker->numberBetween(0, CompanyFixtures::COUNT_COMPANY - 1)
                )
            ) : null;
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CompanyFixtures::class,
        );
    }
}

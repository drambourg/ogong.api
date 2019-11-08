<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CompanyFixtures extends Fixture
{
    const COUNT_COMPANY = 20;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($nCompany = 0; $nCompany < self::COUNT_COMPANY; $nCompany++) {
            $company = new Company();
            $company->setName($faker->company);
            $company->setAddress($faker->address);
            $company->setCreatedAt($faker->dateTimeThisYear('now', 'Europe/Paris'));
            $company->setLogo($faker->imageUrl(200, 200, 'animals'));
            $this->addReference('company' . $nCompany, $company);
            $manager->persist($company);
        }
        $manager->flush();
    }
}

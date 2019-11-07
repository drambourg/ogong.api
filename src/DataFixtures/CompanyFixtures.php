<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $countCompany = 20;

        $faker = Faker\Factory::create('fr_FR');
        for($nCompany = 0 ; $nCompany <$countCompany; $nCompany ++) {
            $company = new Company();
            $company->setName($faker->company);
            $company->setAddress($faker->address);
            $company->setCreatedAt($faker->dateTimeThisYear('now', 'Europe/Paris'));
            $company->setLogo($faker->imageUrl(200, 200, 'abstract'));
            $manager->persist($company);
        }
        $manager->flush();
    }
}

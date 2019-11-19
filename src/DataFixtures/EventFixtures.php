<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    const COUNT_EVENT = 20;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($nEvent = 0; $nEvent < self::COUNT_EVENT; $nEvent++) {
            $event = new Event();
            $event->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true));
            $event->setRegistrationUrl($faker->url);
            $event->setDescription($faker->paragraph($nbSentences = 3, $variableNbSentences = true));
            $event->setEndMessage($faker->paragraph($nbSentences = 1));
            $event->setAddress($faker->address);
            $event->setStartDateTime($faker->dateTimeThisYear);
            $event->setFileAttachment('file.pdf');
            $event->setIsActive($faker->boolean($chanceOfGettingTrue = 90));

            $faker->optional($weight = 0.9)->randomDigit; // 10% chance of NULL
            $event->setCreatedAt($faker->dateTimeThisYear('now', 'Europe/Paris'));
            $event->setLogo($faker->imageUrl(200, 200, 'food'));
            $event->setSize($faker->numberBetween(4, 121));


            $event->setStatus(
                $this->getReference(
                    'event_status' . $faker->numberBetween(1, count(EventStatusFixtures::EVENT_STATUSES))
                )
            );

            $event->setFormat(
                $this->getReference(
                    'event_format' . $faker->numberBetween(1, count(EventFormatFixtures::EVENT_FORMATS))
                )
            );

            $event->setCompany(
                $this->getReference(
                    'company' . $faker->numberBetween(0, CompanyFixtures::COUNT_COMPANY - 1)
                )
            );


            $this->addReference('event' . $nEvent, $event);

            $manager->persist($event);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            EventFormatFixtures::class,
            EventStatusFixtures::class,
            CompanyFixtures::class
        );
    }


}

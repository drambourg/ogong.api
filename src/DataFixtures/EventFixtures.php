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
    const TEAM_SIZES = [9,16,25,49,121];

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
            $event->setStartDateTime($faker->dateTimeBetween($startDate = '-2 years', $endDate = '2 years', $timezone = null ));
            $event->setFileAttachment('file.pdf');
            $event->setIsActive($faker->boolean($chanceOfGettingTrue = 90));
            $event->setCreatedAt($faker->dateTimeThisYear('now', 'Europe/Paris'));
            $event->setLogo($faker->imageUrl(200, 200, 'food'));
            $event->setStatus(
                $this->getReference(
                    'event_status' . $faker->numberBetween(1, count(EventStatusFixtures::EVENT_STATUSES))
                )
            );
            $formatID = $faker->numberBetween(1, count(EventFormatFixtures::EVENT_FORMATS));
            $event->setFormat(
                $this->getReference(
                    'event_format' . $formatID
                )
            );
            if ($formatID == 3) {
                $size = self::TEAM_SIZES[array_rand(self::TEAM_SIZES)];
            } else {
                $size = array_rand(range(1,20))+1;
            }
            $event->setSize($size);
            $event->setCompany(
                $this->getReference(
                    'company' . $faker->numberBetween(1, CompanyFixtures::COUNT_COMPANY - 1)
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

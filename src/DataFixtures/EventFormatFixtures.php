<?php

namespace App\DataFixtures;

use App\Entity\EventFormat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class EventFormatFixtures extends Fixture
{
    const EVENT_FORMATS = [
        [
            'id' => 1,
            'name' => 'Speed meeting'
        ],
        [
            'id' => 2,
            'name' => 'Job dating'
        ],
        [
            'id' => 3,
            'name' => 'Team meeting'
        ],
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::EVENT_FORMATS as $format) {
            $eventFormat = new EventFormat();
            $eventFormat->setName($format['name']);
            $this->addReference('event_format' . $format['id'], $eventFormat);
            $manager->persist($eventFormat);
        }
        $manager->flush();
    }
}

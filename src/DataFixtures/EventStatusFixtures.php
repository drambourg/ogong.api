<?php

namespace App\DataFixtures;

use App\Entity\EventStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventStatusFixtures extends Fixture
{
    const EVENT_STATUSES = [
        [
            'id' => 1,
            'name' => 'En préparation'
        ],
        [
            'id' => 2,
            'name' => 'Inscription'
        ],
        [
            'id' => 3,
            'name' => 'Complet'
        ],
        [
            'id' => 4,
            'name' => 'En cours'
        ],
        [
            'id' => 5,
            'name' => 'Terminé'
        ],
        [
            'id' => 6,
            'name' => 'Date dépassée'
        ]
    ];

    public function load(ObjectManager $manager) {

        foreach (self::EVENT_STATUSES as $status) {
            $eventStatus = new EventStatus();
            $eventStatus->setName($status['name']);
            $this->addReference('event_status' . $status['id'], $eventStatus);
            $manager->persist($eventStatus);
        }
        $manager->flush();
    }
}

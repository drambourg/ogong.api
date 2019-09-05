<?php


namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 * @ApiResource()
 */

//Chaque evenement contient plusieurs tours, ou 'rounds'.
//Chaque round ensuite contient plusieurs tables.

class EventRound
{

    /**
     * @MongoDB\Id(strategy="INCREMENT", type="integer")
     */
    public $id;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $roundNumber;

    /**
     * @MongoDB\ReferenceOne(targetDocument=Event::class, inversedBy="EventRound", storeAs="id")
     */
    protected $event;

    /**
     * @MongoDB\ReferenceMany(targetDocument=EventRoundTable::class, mappedBy="eventRound", storeAs="id")
     */
    protected $eventRoundTables;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRoundNumber()
    {
        return $this->roundNumber;
    }

    /**
     * @param mixed $roundNumber
     */
    public function setRoundNumber($roundNumber): void
    {
        $this->roundNumber = $roundNumber;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event): void
    {
        $this->event = $event;
    }



    public function getEventRoundTables()
    {
        return $this->eventRoundTables;
    }
    public function setEventRoundTables($eventRoundTables): void
    {
        $this->eventRoundTables = $eventRoundTables;
    }
    public function addEventRoundTable(EventRoundTable $eventRoundTable): void
    {
        $eventRoundTable->setEventRound($this);
    }
}
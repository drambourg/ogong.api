<?php


namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 * @ApiResource()
 */



class TableParticipant
{

    /**
     * @MongoDB\Id(strategy="INCREMENT", type="integer")
     */
    public $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument=EventRoundTable::class, inversedBy="TableParticipants", storeAs="id")
     */
    protected $eventRoundTable;


    /**
     * @MongoDB\ReferenceOne(targetDocument=Participant::class, inversedBy="Tables", storeAs="id")
     */
    protected $participant;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEventRoundTable()
    {
        return $this->eventRoundTable;
    }

    /**
     * @param mixed $eventRoundTable
     */
    public function setEventRoundTable($eventRoundTable): void
    {
        $this->eventRoundTable = $eventRoundTable;
    }

    /**
     * @return mixed
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param mixed $participant
     */
    public function setParticipant($participant): void
    {
        $this->participant = $participant;
    }


}
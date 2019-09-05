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

class EventRoundTable
{

    /**
     * @MongoDB\Id(strategy="INCREMENT", type="integer")
     */
    public $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;


    /**
     * @MongoDB\ReferenceOne(targetDocument=EventRound::class, inversedBy="EventRoundTables", storeAs="id")
     */
    protected $eventRound;

    /**
     * @MongoDB\ReferenceMany(targetDocument=TableParticipant::class, mappedBy="eventRoundTable", storeAs="id")
     */
    protected $tableParticipants;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEventRound()
    {
        return $this->eventRound;
    }

    /**
     * @param mixed $eventRound
     */
    public function setEventRound($eventRound): void
    {
        $this->eventRound = $eventRound;
    }


    public function getTableParticipants()
    {
        return $this->tableParticipants;
    }
    public function setTableParticipants($tableParticipants): void
    {
        $this->tableParticipants = $tableParticipants;
    }
    public function addTableParticipant(TableParticipant $tableParticipant): void
    {
        $tableParticipant->setEventRoundTable($this);
    }

}
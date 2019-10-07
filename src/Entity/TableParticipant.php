<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TableParticipantRepository")
 */
class TableParticipant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventRoundTable", inversedBy="tableParticipants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eventRoundTable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="tables")
     * @ORM\JoinColumn(nullable=false)
     */
    private $participant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventRoundTable(): ?EventRoundTable
    {
        return $this->eventRoundTable;
    }

    public function setEventRoundTable(?EventRoundTable $eventRoundTable): self
    {
        $this->eventRoundTable = $eventRoundTable;

        return $this;
    }

    public function getParticipant(): ?Participant
    {
        return $this->participant;
    }

    public function setParticipant(?Participant $participant): self
    {
        $this->participant = $participant;

        return $this;
    }
}

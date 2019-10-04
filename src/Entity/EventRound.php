<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EventRoundRepository")
 */
class EventRound
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $roundNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="eventRounds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventRoundTable", mappedBy="eventRound", orphanRemoval=true)
     */
    private $eventRoundTables;

    public function __construct()
    {
        $this->eventRoundTables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoundNumber(): ?int
    {
        return $this->roundNumber;
    }

    public function setRoundNumber(int $roundNumber): self
    {
        $this->roundNumber = $roundNumber;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return Collection|EventRoundTable[]
     */
    public function getEventRoundTables(): Collection
    {
        return $this->eventRoundTables;
    }

    public function addEventRoundTable(EventRoundTable $eventRoundTable): self
    {
        if (!$this->eventRoundTables->contains($eventRoundTable)) {
            $this->eventRoundTables[] = $eventRoundTable;
            $eventRoundTable->setEventRound($this);
        }

        return $this;
    }

    public function removeEventRoundTable(EventRoundTable $eventRoundTable): self
    {
        if ($this->eventRoundTables->contains($eventRoundTable)) {
            $this->eventRoundTables->removeElement($eventRoundTable);
            // set the owning side to null (unless already changed)
            if ($eventRoundTable->getEventRound() === $this) {
                $eventRoundTable->setEventRound(null);
            }
        }

        return $this;
    }
}

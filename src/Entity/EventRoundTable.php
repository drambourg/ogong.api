<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EventRoundTableRepository")
 */
class EventRoundTable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventRound", inversedBy="eventRoundTables")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eventRound;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TableParticipant", mappedBy="eventRoundTable", orphanRemoval=true)
     */
    private $tableParticipants;

    public function __construct()
    {
        $this->tableParticipants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEventRound(): ?EventRound
    {
        return $this->eventRound;
    }

    public function setEventRound(?EventRound $eventRound): self
    {
        $this->eventRound = $eventRound;

        return $this;
    }

    /**
     * @return Collection|TableParticipant[]
     */
    public function getTableParticipants(): Collection
    {
        return $this->tableParticipants;
    }

    public function addTableParticipant(TableParticipant $tableParticipant): self
    {
        if (!$this->tableParticipants->contains($tableParticipant)) {
            $this->tableParticipants[] = $tableParticipant;
            $tableParticipant->setEventRoundTable($this);
        }

        return $this;
    }

    public function removeTableParticipant(TableParticipant $tableParticipant): self
    {
        if ($this->tableParticipants->contains($tableParticipant)) {
            $this->tableParticipants->removeElement($tableParticipant);
            // set the owning side to null (unless already changed)
            if ($tableParticipant->getEventRoundTable() === $this) {
                $tableParticipant->setEventRoundTable(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
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
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventFormat", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $format;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventStatus", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $registrationUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endMessage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $startTime;

    /**
     * @ORM\Column(type="time")
     */
    private $endTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $speakingTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $changeTime;

    /**
     * @ORM\Column(type="time")
     */
    private $breakStartTime;

    /**
     * @ORM\Column(type="time")
     */
    private $breakEndTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $participantsPerTable;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfTables;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfRounds;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileAttachment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="integer")
     */
    private $participantsRegistered;

    /**
     * @ORM\Column(type="integer")
     */
    private $participantsAttended;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="event", orphanRemoval=true)
     */
    private $participants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventRound", mappedBy="event", orphanRemoval=true)
     */
    private $eventRounds;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->eventRounds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFormat(): ?EventFormat
    {
        return $this->format;
    }

    public function setFormat(?EventFormat $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getStatus(): ?EventStatus
    {
        return $this->status;
    }

    public function setStatus(?EventStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getRegistrationUrl(): ?string
    {
        return $this->registrationUrl;
    }

    public function setRegistrationUrl(string $registrationUrl): self
    {
        $this->registrationUrl = $registrationUrl;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEndMessage(): ?string
    {
        return $this->endMessage;
    }

    public function setEndMessage(string $endMessage): self
    {
        $this->endMessage = $endMessage;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getSpeakingTime(): ?int
    {
        return $this->speakingTime;
    }

    public function setSpeakingTime(int $speakingTime): self
    {
        $this->speakingTime = $speakingTime;

        return $this;
    }

    public function getChangeTime(): ?int
    {
        return $this->changeTime;
    }

    public function setChangeTime(int $changeTime): self
    {
        $this->changeTime = $changeTime;

        return $this;
    }

    public function getBreakStartTime(): ?\DateTimeInterface
    {
        return $this->breakStartTime;
    }

    public function setBreakStartTime(\DateTimeInterface $breakStartTime): self
    {
        $this->breakStartTime = $breakStartTime;

        return $this;
    }

    public function getBreakEndTime(): ?\DateTimeInterface
    {
        return $this->breakEndTime;
    }

    public function setBreakEndTime(\DateTimeInterface $breakEndTime): self
    {
        $this->breakEndTime = $breakEndTime;

        return $this;
    }

    public function getParticipantsPerTable(): ?int
    {
        return $this->participantsPerTable;
    }

    public function setParticipantsPerTable(int $participantsPerTable): self
    {
        $this->participantsPerTable = $participantsPerTable;

        return $this;
    }

    public function getNumberOfTables(): ?int
    {
        return $this->numberOfTables;
    }

    public function setNumberOfTables(int $numberOfTables): self
    {
        $this->numberOfTables = $numberOfTables;

        return $this;
    }

    public function getNumberOfRounds(): ?int
    {
        return $this->numberOfRounds;
    }

    public function setNumberOfRounds(int $numberOfRounds): self
    {
        $this->numberOfRounds = $numberOfRounds;

        return $this;
    }

    public function getFileAttachment(): ?string
    {
        return $this->fileAttachment;
    }

    public function setFileAttachment(string $fileAttachment): self
    {
        $this->fileAttachment = $fileAttachment;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getParticipantsRegistered(): ?int
    {
        return $this->participantsRegistered;
    }

    public function setParticipantsRegistered(int $participantsRegistered): self
    {
        $this->participantsRegistered = $participantsRegistered;

        return $this;
    }

    public function getParticipantsAttended(): ?int
    {
        return $this->participantsAttended;
    }

    public function setParticipantsAttended(int $participantsAttended): self
    {
        $this->participantsAttended = $participantsAttended;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setEvent($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
            // set the owning side to null (unless already changed)
            if ($participant->getEvent() === $this) {
                $participant->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EventRound[]
     */
    public function getEventRounds(): Collection
    {
        return $this->eventRounds;
    }

    public function addEventRound(EventRound $eventRound): self
    {
        if (!$this->eventRounds->contains($eventRound)) {
            $this->eventRounds[] = $eventRound;
            $eventRound->setEvent($this);
        }

        return $this;
    }

    public function removeEventRound(EventRound $eventRound): self
    {
        if ($this->eventRounds->contains($eventRound)) {
            $this->eventRounds->removeElement($eventRound);
            // set the owning side to null (unless already changed)
            if ($eventRound->getEvent() === $this) {
                $eventRound->setEvent(null);
            }
        }

        return $this;
    }
}

<?php


namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 * @ApiResource()
 */

class Event
{

    /**
     * @MongoDB\Id(strategy="INCREMENT", type="integer")
     */
    public $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $title;

    /**
     * @MongoDB\ReferenceOne(targetDocument=EventFormat::class, inversedBy="events", storeAs="id")
     */
    protected $format;

    /**
     * @MongoDB\ReferenceOne(targetDocument=EventStatus::class, inversedBy="events", storeAs="id")
     */
    protected $status;

    /**
     * @MongoDB\ReferenceOne(targetDocument=Company::class, inversedBy="events", storeAs="id")
     */
    protected $company;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $size;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $eventUrl;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $logo;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $description;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $endMessage;


    /**
     * @MongoDB\Field(type="string")
     */
    protected $address;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $date;

    /**
     * @MongoDB\Field(type="timestamp")
     */
    protected $startTime;

    /**
     * @MongoDB\Field(type="timestamp")
     */
    protected $endTime;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $speakingTime;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $changeTime;

    /**
     * @MongoDB\Field(type="timestamp")
     */
    protected $breakStartTime;

    /**
     * @MongoDB\Field(type="timestamp")
     */
    protected $breakEndTime;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $participantsPerTable;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $numberOfTables;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $numberOfRounds;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileAttachment;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $isActive;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $participantsRegistered;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $participantsAttended;

    /**
     * @MongoDB\ReferenceMany(targetDocument=Participant::class, mappedBy="event", storeAs="id")
     */
    protected $participants;

    /**
     * @MongoDB\Field(type="timestamp")
     */
    protected $createdAt;



    public function __construct()
    {
        $this->createdAt = time();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format): void
    {
        $this->format = $format;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getEventUrl()
    {
        return $this->eventUrl;
    }

    /**
     * @param mixed $eventUrl
     */
    public function setEventUrl($eventUrl): void
    {
        $this->eventUrl = $eventUrl;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getEndMessage()
    {
        return $this->endMessage;
    }

    /**
     * @param mixed $endMessage
     */
    public function setEndMessage($endMessage): void
    {
        $this->endMessage = $endMessage;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return mixed
     */
    public function getSpeakingTime()
    {
        return $this->speakingTime;
    }

    /**
     * @param mixed $speakingTime
     */
    public function setSpeakingTime($speakingTime): void
    {
        $this->speakingTime = $speakingTime;
    }

    /**
     * @return mixed
     */
    public function getChangeTime()
    {
        return $this->changeTime;
    }

    /**
     * @param mixed $changeTime
     */
    public function setChangeTime($changeTime): void
    {
        $this->changeTime = $changeTime;
    }

    /**
     * @return mixed
     */
    public function getBreakStartTime()
    {
        return $this->breakStartTime;
    }

    /**
     * @param mixed $breakStartTime
     */
    public function setBreakStartTime($breakStartTime): void
    {
        $this->breakStartTime = $breakStartTime;
    }

    /**
     * @return mixed
     */
    public function getBreakEndTime()
    {
        return $this->breakEndTime;
    }

    /**
     * @param mixed $breakEndTime
     */
    public function setBreakEndTime($breakEndTime): void
    {
        $this->breakEndTime = $breakEndTime;
    }

    /**
     * @return mixed
     */
    public function getParticipantsPerTable()
    {
        return $this->participantsPerTable;
    }

    /**
     * @param mixed $participantsPerTable
     */
    public function setParticipantsPerTable($participantsPerTable): void
    {
        $this->participantsPerTable = $participantsPerTable;
    }

    /**
     * @return mixed
     */
    public function getNumberOfTables()
    {
        return $this->numberOfTables;
    }

    /**
     * @param mixed $numberOfTables
     */
    public function setNumberOfTables($numberOfTables): void
    {
        $this->numberOfTables = $numberOfTables;
    }

    /**
     * @return mixed
     */
    public function getNumberOfRounds()
    {
        return $this->numberOfRounds;
    }

    /**
     * @param mixed $numberOfRounds
     */
    public function setNumberOfRounds($numberOfRounds): void
    {
        $this->numberOfRounds = $numberOfRounds;
    }

    /**
     * @return mixed
     */
    public function getFileAttachment()
    {
        return $this->fileAttachment;
    }

    /**
     * @param mixed $fileAttachment
     */
    public function setFileAttachment($fileAttachment): void
    {
        $this->fileAttachment = $fileAttachment;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getParticipantsRegistered()
    {
        return $this->participantsRegistered;
    }

    /**
     * @param mixed $participantsRegistered
     */
    public function setParticipantsRegistered($participantsRegistered): void
    {
        $this->participantsRegistered = $participantsRegistered;
    }

    /**
     * @return mixed
     */
    public function getParticipantsAttended()
    {
        return $this->participantsAttended;
    }

    /**
     * @param mixed $participantsAttended
     */
    public function setParticipantsAttended($participantsAttended): void
    {
        $this->participantsAttended = $participantsAttended;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function getParticipants()
    {
        return $this->participants;
    }
    public function setParticipants($participants): void
    {
        $this->participants = $participants;
    }
    public function addParticipant(Participant $participant): void
    {
        $participant->setEvent($this);
    }



}
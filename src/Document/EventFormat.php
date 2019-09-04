<?php


namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 * @ApiResource()
 */

class EventFormat
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
     * @MongoDB\ReferenceMany(targetDocument=Event::class, mappedBy="format", storeAs="id")
     */
    protected $events;


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


    public function getEvents()
    {
        return $this->events;
    }
    public function setEvents($events): void
    {
        $this->events = $events;
    }
    public function addEvent(Event $event): void
    {
        $event->setFormat($this);
    }


}
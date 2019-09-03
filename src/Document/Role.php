<?php


namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 * @ApiResource()
 */

class Role
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
     * @MongoDB\ReferenceMany(targetDocument=User::class, mappedBy="role", storeAs="id")
     */
    protected $users;


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


    public function getUsers()
    {
        return $this->users;
    }
    public function setUsers($users): void
    {
        $this->users = $users;
    }
    public function addUser(User $user): void
    {
        $user->setRole($this);
    }


}
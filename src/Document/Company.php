<?php


namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 * @ApiResource()
 */

class Company
{

    /**
     * @MongoDB\Id(strategy="INCREMENT", type="integer")
     */
    public $id;


    /**
     * @MongoDB\ReferenceMany(targetDocument=User::class, mappedBy="company", storeAs="id")
     */
    protected $users;



    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

//    /**
//     * @MongoDB\ReferenceOne(targetDocument=User::class, storeAs="id")
//     */
//    protected $owner;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $address;




    /**
     * @MongoDB\Field(type="string")
     */
    protected $logo;

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

//    /**
//     * @return mixed
//     */
//    public function getOwner()
//    {
//        return $this->owner;
//    }
//
//    /**
//     * @param mixed $owner
//     */
//    public function setOwner($owner): void
//    {
//        $this->owner = $owner;
//    }







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
    public function getCreatedAt()
    {
        return $this->createdAt;
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
        $user->setCompany($this);
    }


}
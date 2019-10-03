<?php


namespace App\Document;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @MongoDB\Document
 * @ApiResource()
 */

class User implements UserInterface
{

    /**
     * @ApiProperty(identifier=true)
     * @MongoDB\Id(strategy="INCREMENT", type="integer")
     */
    public $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument=Role::class, inversedBy="users", storeAs="id")
     */
    protected $role;

    /**
     * @MongoDB\ReferenceOne(targetDocument=Company::class, inversedBy="users", storeAs="id")
     */
    protected $company;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $firstname;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $lastname;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $address;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $email;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $password;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $photo;

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
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
    public function getRoles()
    {
        return array($this->role->getName());
    }

    /**
     * Returns the salt that was originally used to encode the password.
     * This can return null if the password was not encoded using a salt.
     */
    public function getSalt()
    {
    }

    /**
     * Returns the username used to authenticate the user.
     * @return string The username
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * Removes sensitive data from the user.
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
}
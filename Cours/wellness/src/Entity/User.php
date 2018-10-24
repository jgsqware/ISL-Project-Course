<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="userType", type="string")
 * @ORM\DiscriminatorMap({"vendor" = "Vendor"})
 */
abstract class User
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
    private $addressNum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="boolean")
     */
    private $banned;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $signinConfirmed;

    /**
     * @ORM\Column(type="datetime")
     */
    private $signinDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer")
     */
    private $authFailCount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PostCode", inversedBy="users")
     */
    private $postcode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="users")
     */
    private $City;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressNum(): ?int
    {
        return $this->addressNum;
    }

    public function setAddressNum(int $addressNum): self
    {
        $this->addressNum = $addressNum;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getBanned(): ?bool
    {
        return $this->banned;
    }

    public function setBanned(bool $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSigninConfirmed(): ?bool
    {
        return $this->signinConfirmed;
    }

    public function setSigninConfirmed(bool $signinConfirmed): self
    {
        $this->signinConfirmed = $signinConfirmed;

        return $this;
    }

    public function getSigninDate(): ?\DateTimeInterface
    {
        return $this->signinDate;
    }

    public function setSigninDate(\DateTimeInterface $signinDate): self
    {
        $this->signinDate = $signinDate;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAuthFailCount(): ?int
    {
        return $this->authFailCount;
    }

    public function setAuthFailCount(int $authFailCount): self
    {
        $this->authFailCount = $authFailCount;

        return $this;
    }

    public function getPostcode(): ?PostCode
    {
        return $this->postcode;
    }

    public function setPostcode(?PostCode $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->City;
    }

    public function setCity(?City $City): self
    {
        $this->City = $City;

        return $this;
    }
}

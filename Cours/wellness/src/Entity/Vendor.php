<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VendorRepository")
 */
class Vendor extends User
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
    private $emailContact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="vendor")
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="vendor")
     */
    private $Photos;

    public function __construct()
    {
        $this->logo = new ArrayCollection();
        $this->Photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function setVat(string $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getLogo(): Collection
    {
        return $this->logo;
    }

    public function addLogo(Images $logo): self
    {
        if (!$this->logo->contains($logo)) {
            $this->logo[] = $logo;
            $logo->setVendor($this);
        }

        return $this;
    }

    public function removeLogo(Images $logo): self
    {
        if ($this->logo->contains($logo)) {
            $this->logo->removeElement($logo);
            // set the owning side to null (unless already changed)
            if ($logo->getVendor() === $this) {
                $logo->setVendor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getPhotos(): Collection
    {
        return $this->Photos;
    }

    public function addPhoto(Images $photo): self
    {
        if (!$this->Photos->contains($photo)) {
            $this->Photos[] = $photo;
            $photo->setVendor($this);
        }

        return $this;
    }

    public function removePhoto(Images $photo): self
    {
        if ($this->Photos->contains($photo)) {
            $this->Photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getVendor() === $this) {
                $photo->setVendor(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VendorRepository")
 */
class Vendor
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
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="vendor")
     */
    private $Logo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="vendor")
     */
    private $Photos;

    public function __construct()
    {
        $this->Logo = new ArrayCollection();
        $this->Photos = new ArrayCollection();
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

    /**
     * @return Collection|Images[]
     */
    public function getLogo(): Collection
    {
        return $this->Logo;
    }

    public function addLogo(Images $logo): self
    {
        if (!$this->Logo->contains($logo)) {
            $this->Logo[] = $logo;
            $logo->setVendor($this);
        }

        return $this;
    }

    public function removeLogo(Images $logo): self
    {
        if ($this->Logo->contains($logo)) {
            $this->Logo->removeElement($logo);
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

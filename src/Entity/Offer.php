<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 */
class Offer
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
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $availabilityTime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $available;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="Offer")
     */
    private $relatedBookings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="relatedOffers")
     */
    private $owner;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;



    public function __construct()
    {
        $this->relatedBookings = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAvailabilityTime(): ?\DateInterval
    {
        return $this->availabilityTime;
    }

    public function setAvailabilityTime(\DateInterval $availabilityTime): self
    {
        $this->availabilityTime = $availabilityTime;

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getRelatedBookings(): Collection
    {
        return $this->relatedBookings;
    }

    public function addRelatedBooking(Booking $relatedBooking): self
    {
        if (!$this->relatedBookings->contains($relatedBooking)) {
            $this->relatedBookings[] = $relatedBooking;
            $relatedBooking->setOffer($this);
        }

        return $this;
    }

    public function removeRelatedBooking(Booking $relatedBooking): self
    {
        if ($this->relatedBookings->contains($relatedBooking)) {
            $this->relatedBookings->removeElement($relatedBooking);
            // set the owning side to null (unless already changed)
            if ($relatedBooking->getOffer() === $this) {
                $relatedBooking->setOffer(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->title;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="relatedBookings")
     */
    private $Offer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="relatedBookings")
     */
    private $guest;

    /**
     * @ORM\Column(type="date")
     */
    private $beginDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isBack;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="relatedBooking")
     */
    private $relatedMessages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rate", mappedBy="relatedBooking")
     */
    private $relatedRates;

    public function __construct()
    {
        $this->relatedMessages = new ArrayCollection();
        $this->relatedRates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffer(): ?Offer
    {
        return $this->Offer;
    }

    public function setOffer(?Offer $Offer): self
    {
        $this->Offer = $Offer;

        return $this;
    }

    public function getGuest(): ?User
    {
        return $this->guest;
    }

    public function setGuest(?User $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->beginDate;
    }

    public function setBeginDate(\DateTimeInterface $beginDate): self
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getIsBack(): ?bool
    {
        return $this->isBack;
    }

    public function setIsBack(bool $isBack): self
    {
        $this->isBack = $isBack;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getRelatedMessages(): Collection
    {
        return $this->relatedMessages;
    }

    public function addRelatedMessage(Message $relatedMessage): self
    {
        if (!$this->relatedMessages->contains($relatedMessage)) {
            $this->relatedMessages[] = $relatedMessage;
            $relatedMessage->setRelatedBooking($this);
        }

        return $this;
    }

    public function removeRelatedMessage(Message $relatedMessage): self
    {
        if ($this->relatedMessages->contains($relatedMessage)) {
            $this->relatedMessages->removeElement($relatedMessage);
            // set the owning side to null (unless already changed)
            if ($relatedMessage->getRelatedBooking() === $this) {
                $relatedMessage->setRelatedBooking(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getRelatedRates(): Collection
    {
        return $this->relatedRates;
    }

    public function addRelatedRate(Rate $relatedRate): self
    {
        if (!$this->relatedRates->contains($relatedRate)) {
            $this->relatedRates[] = $relatedRate;
            $relatedRate->setRelatedBooking($this);
        }

        return $this;
    }

    public function removeRelatedRate(Rate $relatedRate): self
    {
        if ($this->relatedRates->contains($relatedRate)) {
            $this->relatedRates->removeElement($relatedRate);
            // set the owning side to null (unless already changed)
            if ($relatedRate->getRelatedBooking() === $this) {
                $relatedRate->setRelatedBooking(null);
            }
        }

        return $this;
    }


}

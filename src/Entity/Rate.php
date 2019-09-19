<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RateRepository")
 */
class Rate
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
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Booking", inversedBy="relatedRates")
     */
    private $relatedBooking;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="givenRatings")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="receivedRatings")
     */
    private $ratedUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getRelatedBooking(): ?Booking
    {
        return $this->relatedBooking;
    }

    public function setRelatedBooking(?Booking $relatedBooking): self
    {
        $this->relatedBooking = $relatedBooking;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getRatedUser(): ?User
    {
        return $this->ratedUser;
    }

    public function setRatedUser(?User $ratedUser): self
    {
        $this->ratedUser = $ratedUser;

        return $this;
    }
}

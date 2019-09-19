<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $consulted;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $messageString;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="receivedMessages")
     */
    private $recipient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="sentMessages")
     */
    private $emitter;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Booking", inversedBy="relatedMessages")
     */
    private $relatedBooking;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConsulted(): ?bool
    {
        return $this->consulted;
    }

    public function setConsulted(bool $consulted): self
    {
        $this->consulted = $consulted;

        return $this;
    }

    public function getMessageString(): ?string
    {
        return $this->messageString;
    }

    public function setMessageString(string $messageString): self
    {
        $this->messageString = $messageString;

        return $this;
    }

    public function getRecipient(): ?User
    {
        return $this->recipient;
    }

    public function setRecipient(?User $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getEmitter(): ?User
    {
        return $this->emitter;
    }

    public function setEmitter(?User $emitter): self
    {
        $this->emitter = $emitter;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
}

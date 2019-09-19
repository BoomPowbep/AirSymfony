<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="guest")
     */
    private $relatedBookings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="recipient")
     */
    private $receivedMessages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="emitter")
     */
    private $sentMessages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rate", mappedBy="author")
     */
    private $givenRatings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rate", mappedBy="ratedUser")
     */
    private $receivedRatings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Offer", mappedBy="owner")
     */
    private $relatedOffers;

    public function __construct()
    {
        $this->relatedBookings = new ArrayCollection();
        $this->receivedMessages = new ArrayCollection();
        $this->sentMessages = new ArrayCollection();
        $this->givenRatings = new ArrayCollection();
        $this->receivedRatings = new ArrayCollection();
        $this->relatedOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

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
            $relatedBooking->setGuest($this);
        }

        return $this;
    }

    public function removeRelatedBooking(Booking $relatedBooking): self
    {
        if ($this->relatedBookings->contains($relatedBooking)) {
            $this->relatedBookings->removeElement($relatedBooking);
            // set the owning side to null (unless already changed)
            if ($relatedBooking->getGuest() === $this) {
                $relatedBooking->setGuest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getReceivedMessages(): Collection
    {
        return $this->receivedMessages;
    }

    public function addReceivedMessage(Message $receivedMessage): self
    {
        if (!$this->receivedMessages->contains($receivedMessage)) {
            $this->receivedMessages[] = $receivedMessage;
            $receivedMessage->setRecipient($this);
        }

        return $this;
    }

    public function removeReceivedMessage(Message $receivedMessage): self
    {
        if ($this->receivedMessages->contains($receivedMessage)) {
            $this->receivedMessages->removeElement($receivedMessage);
            // set the owning side to null (unless already changed)
            if ($receivedMessage->getRecipient() === $this) {
                $receivedMessage->setRecipient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getSentMessages(): Collection
    {
        return $this->sentMessages;
    }

    public function addSentMessage(Message $sentMessage): self
    {
        if (!$this->sentMessages->contains($sentMessage)) {
            $this->sentMessages[] = $sentMessage;
            $sentMessage->setEmitter($this);
        }

        return $this;
    }

    public function removeSentMessage(Message $sentMessage): self
    {
        if ($this->sentMessages->contains($sentMessage)) {
            $this->sentMessages->removeElement($sentMessage);
            // set the owning side to null (unless already changed)
            if ($sentMessage->getEmitter() === $this) {
                $sentMessage->setEmitter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getGivenRatings(): Collection
    {
        return $this->givenRatings;
    }

    public function addGivenRating(Rate $givenRating): self
    {
        if (!$this->givenRatings->contains($givenRating)) {
            $this->givenRatings[] = $givenRating;
            $givenRating->setAuthor($this);
        }

        return $this;
    }

    public function removeGivenRating(Rate $givenRating): self
    {
        if ($this->givenRatings->contains($givenRating)) {
            $this->givenRatings->removeElement($givenRating);
            // set the owning side to null (unless already changed)
            if ($givenRating->getAuthor() === $this) {
                $givenRating->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getReceivedRatings(): Collection
    {
        return $this->receivedRatings;
    }

    public function addReceivedRating(Rate $receivedRating): self
    {
        if (!$this->receivedRatings->contains($receivedRating)) {
            $this->receivedRatings[] = $receivedRating;
            $receivedRating->setRatedUser($this);
        }

        return $this;
    }

    public function removeReceivedRating(Rate $receivedRating): self
    {
        if ($this->receivedRatings->contains($receivedRating)) {
            $this->receivedRatings->removeElement($receivedRating);
            // set the owning side to null (unless already changed)
            if ($receivedRating->getRatedUser() === $this) {
                $receivedRating->setRatedUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getRelatedOffers(): Collection
    {
        return $this->relatedOffers;
    }

    public function addRelatedOffer(Offer $relatedOffer): self
    {
        if (!$this->relatedOffers->contains($relatedOffer)) {
            $this->relatedOffers[] = $relatedOffer;
            $relatedOffer->setOwner($this);
        }

        return $this;
    }

    public function removeRelatedOffer(Offer $relatedOffer): self
    {
        if ($this->relatedOffers->contains($relatedOffer)) {
            $this->relatedOffers->removeElement($relatedOffer);
            // set the owning side to null (unless already changed)
            if ($relatedOffer->getOwner() === $this) {
                $relatedOffer->setOwner(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->username;
    }
}

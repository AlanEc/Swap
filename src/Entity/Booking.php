<?php

namespace App\Entity;

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
     * @ORM\Column(type="datetime")
     */
    private $date_start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_end;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disabled;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", length=255)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SwapService", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $swapService;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BookingState", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bookingSate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BookingType", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bookingType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getSwapService(): ?SwapService
    {
        return $this->swapService;
    }

    public function setSwapService(?SwapService $swapService): self
    {
        $this->swapService = $swapService;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBookingSate(): ?BookingState
    {
        return $this->bookingSate;
    }

    public function setBookingSate(?BookingState $bookingSate): self
    {
        $this->bookingSate = $bookingSate;

        return $this;
    }

    public function getBookingType(): ?BookingType
    {
        return $this->bookingType;
    }

    public function setBookingType(?BookingType $bookingType): self
    {
        $this->bookingType = $bookingType;

        return $this;
    }
}

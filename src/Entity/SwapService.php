<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Serializer as Serializer;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SwapServiceRepository")
 */
class SwapService
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $people_quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $latitude;

    /**
     * @ORM\Column(type="integer")
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $adress_1;

    /**
     * @ORM\Column(type="string", length=45, nullable=true))
     */
    private $adress_2;

    /**
     * @ORM\Column(type="string", length=45, nullable=true))
     */
    private $adress_3;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $country;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disabled;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="swapServices", cascade={"persist"} )
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SwapServiceType", inversedBy="swapServices",  cascade={"persist"} ))
     * @ORM\JoinColumn(nullable=true)
     */
    private $swapServiceType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="swapService")
     */
    private $bookings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="swapService")
     */
    private $transactions;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->transactions = new ArrayCollection();
    }
    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPeopleQuantity(): ?string
    {
        return $this->people_quantity;
    }

    public function setPeopleQuantity(?string $people_quantity): self
    {
        $this->people_quantity = $people_quantity;

        return $this;
    }

    public function getLatitude(): ?int
    {
        return $this->latitude;
    }

    public function setLatitude(int $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?int
    {
        return $this->longitude;
    }

    public function setLongitude(int $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getAdress1(): ?string
    {
        return $this->adress_1;
    }

    public function setAdress1(string $adress_1): self
    {
        $this->adress_1 = $adress_1;

        return $this;
    }

    public function getAdress2(): ?string
    {
        return $this->adress_2;
    }

    public function setAdress2(string $adress_2): self
    {
        $this->adress_2 = $adress_2;

        return $this;
    }

    public function getAdress3(): ?string
    {
        return $this->adress_3;
    }

    public function setAdress3(string $adress_3): self
    {
        $this->adress_3 = $adress_3;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

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

    public function getSwapServiceType(): ?SwapServiceType
    {
        return $this->swapServiceType;
    }

    public function setSwapServiceType(?SwapServiceType $swapServiceType): self
    {
        $this->swapServiceType = $swapServiceType;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setSwapService($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getSwapService() === $this) {
                $booking->setSwapService(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setSwapService($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getSwapService() === $this) {
                $transaction->setSwapService(null);
            }
        }

        return $this;
    }
}

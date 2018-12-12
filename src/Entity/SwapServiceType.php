<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Serializer as Serializer;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SwapServiceTypeRepository")
 */
class SwapServiceType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $label;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $value_scale;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disabled;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SwapService", mappedBy="swapServiceType")
     */
    private $swapServices;


    public function __construct()
    {
        $this->swapServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getValueScale(): ?int
    {
        return $this->value_scale;
    }

    public function setValueScale(?int $value_scale): self
    {
        $this->value_scale = $value_scale;

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

    /**
     * @return Collection|SwapService[]
     */
    public function getSwapServices(): Collection
    {
        return $this->swapServices;
    }

    public function addSwapService(SwapService $swapService): self
    {
        if (!$this->swapServices->contains($swapService)) {
            $this->swapServices[] = $swapService;
            $swapService->setSwapServiceType($this);
        }

        return $this;
    }

    public function removeSwapService(SwapService $swapService): self
    {
        if ($this->swapServices->contains($swapService)) {
            $this->swapServices->removeElement($swapService);
            // set the owning side to null (unless already changed)
            if ($swapService->getSwapServiceType() === $this) {
                $swapService->setSwapServiceType(null);
            }
        }

        return $this;
    }
}

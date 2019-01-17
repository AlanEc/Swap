<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
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
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $date_transation_start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_transaction_end;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userSender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userReceiver;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SwapService", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $swapService;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDateTransationStart(): ?\DateTimeInterface
    {
        return $this->date_transation_start;
    }

    public function setDateTransationStart(\DateTimeInterface $date_transation_start): self
    {
        $this->date_transation_start = $date_transation_start;

        return $this;
    }

    public function getDateTransactionEnd(): ?\DateTimeInterface
    {
        return $this->date_transaction_end;
    }

    public function setDateTransactionEnd(?\DateTimeInterface $date_transaction_end): self
    {
        $this->date_transaction_end = $date_transaction_end;

        return $this;
    }

    public function getUserSender(): ?User
    {
        return $this->userSender;
    }

    public function setUserSender(?User $userSender): self
    {
        $this->userSender = $userSender;

        return $this;
    }

    public function getUserReceiver(): ?User
    {
        return $this->userReceiver;
    }

    public function setUserReceiver(?User $userReceiver): self
    {
        $this->userReceiver = $userReceiver;

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
}

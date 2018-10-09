<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $date_transation_start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_transaction_end;

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
}

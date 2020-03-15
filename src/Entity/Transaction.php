<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Account;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     attributes={"normalization_context"={"groups"={"transaction_get"}}})
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{

    const TRANSACTION_STATUS_PENDING = 1;
    const TRANSACTION_STATUS_APPROVED = 2;
    const TRANSACTION_STATUS_REJECTED = 3;

    public function __construct()
    {
        $this->status = self::TRANSACTION_STATUS_PENDING;
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"transaction_get"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(name="payer_id", referencedColumnName="id")
     @Groups({"transaction_get"})
     */
    private $payer;

    /**
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(name="payee_id", referencedColumnName="id")
     * @Groups({"transaction_get"})
     */
    private $payee;

    /**
     * @ORM\Column(type="float")
     * @Groups({"transaction_get"})
     */
    private $value;

    /**
    * @ORM\Column(type="datetime")
     * @Groups({"transaction_get"})
    */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"transaction_get"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"transaction_get"})
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param mixed $payer
     * @return Transaction
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayee()
    {
        return $this->payee;
    }

    /**
     * @param mixed $payee
     * @return Transaction
     */
    public function setPayee($payee)
    {
        $this->payee = $payee;
        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return Transaction
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return Transaction
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Transaction
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

}

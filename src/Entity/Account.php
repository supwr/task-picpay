<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
{

    const ACCOUNT_TYPE_CONSUMER = 1;
    const ACCOUNT_TYPE_SELLER = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user_get", "transaction_get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user_get"})
     */
    private $cnpj;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user_get"})
     */
    private $fantasy_name;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user_get"})
     */
    private $social_name;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Groups({"user_get"})
     */
    private $username;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user_get"})
     */
    private $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Account
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return Account
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     * @return Account
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFantasyName()
    {
        return $this->fantasy_name;
    }

    /**
     * @param mixed $fantasy_name
     * @return Account
     */
    public function setFantasyName($fantasy_name)
    {
        $this->fantasy_name = $fantasy_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSocialName()
    {
        return $this->social_name;
    }

    /**
     * @param mixed $social_name
     * @return Account
     */
    public function setSocialName($social_name)
    {
        $this->social_name = $social_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return Account
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

}

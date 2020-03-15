<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Filter\UsersSearchFilter;
use Symfony\Component\Serializer\Annotation\SerializedName;


/**
 * @ApiResource(attributes={"normalization_context"={"groups"={"user_get"}}})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiFilter(UsersSearchFilter::class)
 * @ApiFilter(OrderFilter::class, properties={"fullName": { "nulls_comparison": OrderFilter::NULLS_SMALLEST, "default_direction": "ASC" }}, arguments={"orderParameterName"="order"})
 * @ApiFilter(SearchFilter::class, properties={"id":"exact", "fullName": "start"})
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user_get"})
     */
    private $id;

    /**
    * @ORM\Column(type="string", length=225)
    * @SerializedName("full_name")
    * @Groups({"user_get"})
    */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=225, unique=true)
     * @Groups({"user_get"})
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=225, unique=true)
     * @Groups({"user_get"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=225)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=225)
     * @SerializedName("phone_number")
     * @Groups({"user_get"})
     */
    private $phoneNumber;

    /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="user")
     * @Groups({"user_get"})
     */
    public $accounts;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     * @return User
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param mixed $accounts
     * @return User
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
        return $this;
    }

}
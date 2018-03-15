<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */

/*@ORM\Entity(repositoryClass="\App\Repository\User")*/
class User
{
    /**
     * @var string $login
     *
     * @ORM\Column(name="login", type="string", length=20, nullable=false)
     * @Groups({"default"})
     */
    private $login;

    /**
     * @var int $accountId
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     * @Groups({"default"})
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     * @Groups({"default"})
     */
    private $name = '';

    /**
     * @var string $family
     *
     * @ORM\Column(name="family", type="string", nullable=true)
     * @Groups({"default"})
     */
    private $family = '';

    /**
     * @var string $picture
     *
     * @ORM\Column(name="picture", type="string", nullable=true)
     * @Groups({"default"})
     */
    private $picture = '';

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", nullable=false)
     * @Groups({"admin"})
     */
    private $password = '';

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", nullable=false)
     * @Groups({"default"})
     */
    private $email;

    /**
     * @var string $gender
     *
     * @ORM\Column(name="gender", type="string", nullable=false)
     * @Groups({"default"})
     */
    private $gender = 'male';

    /**
     * @var string $token
     *
     * @ORM\Column(name="token", type="string", length=1000, nullable=false)
     * @Groups({"admin"})
     */
    private $token = '';

    /**
     * @var \DateTime
     * @ORM\Column(name="when_add_token", type="datetime", nullable=false)
     * @Groups({"default"})
     */
    private $whenAddToken;

    /**
     * @var \DateTime
     * @ORM\Column(name="when_add", type="datetime", nullable=false)
     * @Groups({"default"})
     */
    private $whenAdd;

    /**
     * Лічильники клієнта
     *
     * @var Collection|Counter[] $counters
     *
     * @ORM\OneToMany(targetEntity="Counter", mappedBy="user")
     * @Groups({"default"})
     *
     */
    private $counters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->counters = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFamily(): string
    {
        return $this->family;
    }

    /**
     * @param string $family
     */
    public function setFamily(string $family): void
    {
        $this->family = $family;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return \DateTime
     */
    public function getWhenAddToken(): \DateTime
    {
        return $this->whenAddToken;
    }

    /**
     * @param \DateTime $whenAddToken
     */
    public function setWhenAddToken(\DateTime $whenAddToken): void
    {
        $this->whenAddToken = $whenAddToken;
    }

    /**
     * @return \DateTime
     */
    public function getWhenAdd(): \DateTime
    {
        return $this->whenAdd;
    }

    /**
     * @param \DateTime $whenAdd
     */
    public function setWhenAdd(\DateTime $whenAdd): void
    {
        $this->whenAdd = $whenAdd;
    }

    /**
     * @return Collection|Counter[]
     */
    public function getCounters(): Collection
    {
        return $this->counters;
    }

    /**
     * @param Counter $counter
     *
     * @return User
     */
    public function addCounter(Counter $counter): self
    {
        $this->counters->add($counter);
        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Id
     */
    private $login;

    /**
     * @var int $accountId
     *
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

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
}

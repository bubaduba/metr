<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Counter
 *
 * @ORM\Table(name="counters")
 * @ORM\Entity
 */

/*@ORM\Entity(repositoryClass="\App\Repository\User")*/
class Counter
{
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"default"})
     */
    private $id;

    /**
     * @var $user
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="counters")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Показники лічильників
     * @var Collection|Indicator[] $indicators
     * @ORM\OneToMany(targetEntity="Indicator", mappedBy="indicator")
     * @Groups({"default"})
     *
     */
    private $indicators;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->indicators = new ArrayCollection();
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
     * @return Collection|Indicator[]
     */
    public function getIndicators(): Collection
    {
        return $this->indicators;
    }

    /**
     * @param Indicator $indicator
     *
     * @return Counter
     */
    public function addIndicator(Indicator $indicator): self
    {
        $this->indicators->add($indicator);
        return $this;
    }
}

<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Indicator
 *
 * @ORM\Table(name="indicators")
 * @ORM\Entity
 */

/*@ORM\Entity(repositoryClass="\App\Repository\User")*/
class Indicator
{
    public function __construct()
    {
        $this->year = new DateTime();
        $this->lastUpdate = new DateTime();
    }

    /**
     * @var $indicator
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Counter", inversedBy="indicators")
     * @ORM\JoinColumn(name="counter_id", referencedColumnName="id")
     */
    private $indicator;

    /**
     * @var $year
     *
     * @ORM\Column(name="year", columnDefinition="YEAR")
     * @Groups({"default"})
     */
    private $year;

    /**
     * @var \DateTime
     * @ORM\Column(name="last_update", type="datetime", nullable=false)
     * @Groups({"default"})
     */
    private $lastUpdate;

    /**
     * @var int $january
     * @ORM\Column(name="january", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $january;

    /**
     * @var int $february
     * @ORM\Column(name="february", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $february;

    /**
     * @var int $march
     * @ORM\Column(name="march", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $march;

    /**
     * @var int $april
     * @ORM\Column(name="april", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $april;

    /**
     * @var int $may
     * @ORM\Column(name="may", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $may;

    /**
     * @var int $june
     * @ORM\Column(name="june", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $june;

    /**
     * @var int $july
     * @ORM\Column(name="july", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $july;

    /**
     * @var int $august
     * @ORM\Column(name="august", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $august;

    /**
     * @var int $september
     * @ORM\Column(name="september", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $september;

    /**
     * @var int $october
     * @ORM\Column(name="october", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $october;

    /**
     * @var int $november
     * @ORM\Column(name="november", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $november;

    /**
     * @var int $december
     * @ORM\Column(name="december", type="integer", nullable=true)
     * @Groups({"default"})
     */
    private $december;

    /**
     * @return \DateTime
     */
    public function getLastUpdate(): \DateTime
    {
        return $this->lastUpdate;
    }

    /**
     * @param \DateTime $lastUpdate
     */
    public function setLastUpdate(\DateTime $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * @return int
     */
    public function getJanuary(): int
    {
        return $this->january;
    }

    /**
     * @param int $january
     */
    public function setJanuary(int $january): void
    {
        $this->january = $january;
    }

    /**
     * @return int
     */
    public function getFebruary(): int
    {
        return $this->february;
    }

    /**
     * @param int $february
     */
    public function setFebruary(int $february): void
    {
        $this->february = $february;
    }

    /**
     * @return int
     */
    public function getMarch(): int
    {
        return $this->march;
    }

    /**
     * @param int $march
     */
    public function setMarch(int $march): void
    {
        $this->march = $march;
    }

    /**
     * @return int
     */
    public function getApril(): int
    {
        return $this->april;
    }

    /**
     * @param int $april
     */
    public function setApril(int $april): void
    {
        $this->april = $april;
    }

    /**
     * @return int
     */
    public function getMay(): int
    {
        return $this->may;
    }

    /**
     * @param int $may
     */
    public function setMay(int $may): void
    {
        $this->may = $may;
    }

    /**
     * @return int
     */
    public function getJune(): int
    {
        return $this->june;
    }

    /**
     * @param int $june
     */
    public function setJune(int $june): void
    {
        $this->june = $june;
    }

    /**
     * @return int
     */
    public function getJuly(): int
    {
        return $this->july;
    }

    /**
     * @param int $july
     */
    public function setJuly(int $july): void
    {
        $this->july = $july;
    }

    /**
     * @return int
     */
    public function getAugust(): int
    {
        return $this->august;
    }

    /**
     * @param int $august
     */
    public function setAugust(int $august): void
    {
        $this->august = $august;
    }

    /**
     * @return int
     */
    public function getSeptember(): int
    {
        return $this->september;
    }

    /**
     * @param int $september
     */
    public function setSeptember(int $september): void
    {
        $this->september = $september;
    }

    /**
     * @return int
     */
    public function getOctober(): int
    {
        return $this->october;
    }

    /**
     * @param int $october
     */
    public function setOctober(int $october): void
    {
        $this->october = $october;
    }

    /**
     * @return int
     */
    public function getNovember(): int
    {
        return $this->november;
    }

    /**
     * @param int $november
     */
    public function setNovember(int $november): void
    {
        $this->november = $november;
    }

    /**
     * @return int
     */
    public function getDecember(): int
    {
        return $this->december;
    }

    /**
     * @param int $december
     */
    public function setDecember(int $december): void
    {
        $this->december = $december;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }
}

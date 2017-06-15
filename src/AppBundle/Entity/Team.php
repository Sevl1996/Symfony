<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="League", type="string", length=255)
     */
    private $league;

    /**
     * @var string
     *
     * @ORM\Column(name="Country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="Logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="HomeArena", type="string", length=255)
     */
    private $homeArena;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set league
     *
     * @param string $league
     *
     * @return Team
     */
    public function setLeague($league)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return string
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Team
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Team
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set homeArena
     *
     * @param string $homeArena
     *
     * @return Team
     */
    public function setHomeArena($homeArena)
    {
        $this->homeArena = $homeArena;

        return $this;
    }

    /**
     * Get homeArena
     *
     * @return string
     */
    public function getHomeArena()
    {
        return $this->homeArena;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->name;
    }

}

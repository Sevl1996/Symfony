<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Team;


/**
 * Game
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="first_team_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $firstTeam;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="second_team_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $secondTeam;

    /**
     * @var int
     *
     * @ORM\Column(name="firstTeamGoals", type="integer", nullable=true)
     */
    private $firstTeamGoals;

    /**
     * @var int
     *
     * @ORM\Column(name="secondTeamGoals", type="integer", nullable=true)
     */
    private $secondTeamGoals;


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
     * @return mixed
     */
    public function getFirstTeam()
    {
        return $this->firstTeam;
    }

    /**
     * @param $firstTeam
     * @internal param \AppBundle\Entity\Team $firstTeam
     */
    public function setFirstTeam($firstTeam)
    {
        $this->firstTeam = $firstTeam;
    }

    /**
     * @return mixed
     */
    public function getSecondTeam()
    {
        return $this->secondTeam;
    }

    /**
     * @param $secondTeam
     * @internal param \AppBundle\Entity\Team $secondTeam
     */
    public function setSecondTeam($secondTeam)
    {

        $this->secondTeam = $secondTeam;
    }



    /**
     * Set firstTeamGoals
     *
     * @param integer $firstTeamGoals
     *
     * @return Game
     */
    public function setFirstTeamGoals($firstTeamGoals)
    {
        $this->firstTeamGoals = $firstTeamGoals;

        return $this;
    }

    /**
     * Get firstTeamGoals
     *
     * @return int
     */
    public function getFirstTeamGoals()
    {
        return $this->firstTeamGoals;
    }

    /**
     * Set secondTeamGoals
     *
     * @param integer $secondTeamGoals
     *
     * @return Game
     */
    public function setSecondTeamGoals($secondTeamGoals)
    {
        $this->secondTeamGoals = $secondTeamGoals;

        return $this;
    }

    /**
     * Get secondTeamGoals
     *
     * @return int
     */
    public function getSecondTeamGoals()
    {
        return $this->secondTeamGoals;
    }

}

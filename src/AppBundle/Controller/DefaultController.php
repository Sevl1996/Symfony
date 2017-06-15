<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Team;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/stat", name="aboutpage")
     */
    public function aboutAction()
    {
        $goals = $this->getHomeGoals();
        $secgoals = $this->getGestGoals();
        $percent = ($goals * 100)/($goals + $secgoals);
        $percents = (int)$percent;
        return $this->render('default/stat.html.twig', array(
            'homegoals' => $goals,
            'gestgoals' => $secgoals,
            'percent' => $percents
        ));
    }

    /**
     * @Route("/news1", name="news1")
     */
    public function news1Action()
    {
        return $this->render('default/news1.html.twig', array(
        ));
    }

    /**
     * @Route("/news2", name="news2")
     */
    public function news3Action()
    {
        return $this->render('default/news2.html.twig', array(
        ));
    }

    /**
     * @Route("/news3", name="news3")
     */
    public function news2Action()
    {
        return $this->render('default/news3.html.twig', array(
        ));
    }

    /**
     * @return int
     */
    public function getHomeGoals()
    {
        $games=$this->getDoctrine()->getRepository("AppBundle:Game")->findAll();

        $goals = 0;

        foreach ($games as $game){
            $goal = $game->getFirstTeamGoals();
            //echo "<script>console.log($this->$game->getFirstTeamGoal())</script>";
            $goals += $goal;
        }
        return $goals;
    }

    /**
     * @return int
     */
    public function getGestGoals()
    {
        $games=$this->getDoctrine()->getRepository("AppBundle:Game")->findAll();

        $goals = 0;

        foreach ($games as $game){
            $goal = $game->getSecondTeamGoals();
            $goals += $goal;
        }
        return $goals;
    }

}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Entity\Team;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Common\Collections\ArrayCollection;

class GameController extends Controller
{
    /**
     * @Route("/games", name = "games")
     */
    public function listAction()
    {
        $games=$this->getDoctrine()->getRepository("AppBundle:Game")->findAll();
        return $this->render('AppBundle:Game:list.html.twig', array(
            'games' => $games
        ));
    }

    /**
     * @Route("/game/addGame")
     */
    public function addAction(Request $request)
    {
        $game=new Game;
        $form=$this->createFormBuilder($game)
            ->add('firstTeam', EntityType::class, array(
                'label'=>'First team',
                'class' =>'AppBundle:Team',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false ))
            ->add('firstTeamGoals',TextType::class, array(
                "label" => "First team goals",
                "attr" => array(
                    'class' => 'form-control',
                    'style' => 'font-color:black'
                )
            ))
            ->add('secondTeamGoals',TextType::class, array(
                "label" => "Second team goals",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('secondTeam', EntityType::class, array(
                'label'=>'Second team',
                'class' =>'AppBundle:Team',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false ))
            ->add('submit', SubmitType::class,array(
                'label'=> 'Submit',
                'attr' => array(
                    'class' => 'btn btn-success'
                ))) ->getForm();
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid() &&
            ($form['firstTeam']->getData() != $form['secondTeam']->getData())
            && $form['firstTeamGoals']->getData() >= 0
            && $form['secondTeamGoals']->getData() >= 0
            ){

            echo "<script>console.log('Start creating')</script>";

            $firstTeam=$form['firstTeam']->getData();
            $secondTeam=$form['secondTeam']->getData();
            $firstTeamGoals=$form['firstTeamGoals']->getData();
            $secondTeamGoals=$form['secondTeamGoals']->getData();

            $game->setFirstTeam($firstTeam);
            $game->setSecondTeam($secondTeam);
            $game->setSecondTeamGoals($firstTeamGoals);
            $game->setSecondTeamGoals($secondTeamGoals);

            $em=$this->getDoctrine()->getManager();

            $em->persist($game);

            $em->flush();

            return $this->redirectToRoute("games");
        }

        return $this->render('AppBundle:Game:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/game/editGame/{id}")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id,Request $request)
    {
        $game=$this->getDoctrine()->getRepository("AppBundle:Game")->find($id);
        $form=$this->createFormBuilder($game)
            ->add('firstTeam', EntityType::class, array(
                'label'=>'First team',
                'class' =>'AppBundle:Team',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false ))
            ->add('firstTeamGoals',TextType::class, array(
                "label" => "First team goals",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('secondTeamGoals',TextType::class, array(
                "label" => "Second team goals",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('secondTeam', EntityType::class, array(
                'label'=>'Second team',
                'class' =>'AppBundle:Team',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false ))
            ->add('submit', SubmitType::class,array(
                'label'=> 'Submit',
                'attr' => array(
                    'class' => 'btn btn-success'
                ))) ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $firstTeam=$form['firstTeam']->getData();
            $secondTeam=$form['secondTeam']->getData();
            $firstTeamGoals=$form['firstTeamGoals']->getData();
            $secondTeamGoals=$form['secondTeamGoals']->getData();

            $game->setFirstTeam($firstTeam);
            $game->setSecondTeam($secondTeam);
            $game->setSecondTeamGoals($firstTeamGoals);
            $game->setSecondTeamGoals($secondTeamGoals);

            $em = $this->getDoctrine()->getManager();

            $em->persist($game);

            $em->flush();

            return $this->redirectToRoute("games");
        }
        return $this->render('AppBundle:Game:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/game/deleteGame/{id}")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $team=$this->getDoctrine()->getRepository("AppBundle:Game")->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($team);
        $em->flush();
        return $this->redirectToRoute("games");
    }

}

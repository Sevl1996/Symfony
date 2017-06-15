<?php

namespace AppBundle\Controller;

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

class TeamController extends Controller
{
    /**
     * @Route("/teams" , name = "teams")
     */
    public function listAction()
    {
        $teams=$this->getDoctrine()->getRepository("AppBundle:Team")->findAll();
        return $this->render('AppBundle:Team:list.html.twig', array(
            'teams' => $teams
        ));
    }

    /**
     * @Route("/team/addTeam")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $team=new Team;
        $form=$this->createFormBuilder($team)
            ->add('name',TextType::class, array(
                "label" => "Team name",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('league',TextType::class, array(
                "label" => "League",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('country',TextType::class, array(
                "label" => "Country",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('logo',TextType::class, array(
                "label" => "Logo",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('homeArena',TextType::class, array(
                "label" => "Home Arena",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('submit', SubmitType::class,array(
                'label'=> 'Submit',
                'attr' => array(
                    'class' => 'btn btn-success'
                ))) ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();
            $league=$form['league']->getData();
            $country=$form['country']->getData();
            $logo=$form['logo']->getData();
            $homeArena=$form['homeArena']->getData();

            $team->setName($name);
            $team->setLeague($league);
            $team->setCountry($country);
            $team->setLogo($logo);
            $team->setHomeArena($homeArena);

            $em=$this->getDoctrine()->getManager();

            $em->persist($team);

            $em->flush();

            return $this->redirectToRoute("teams");
        }

        return $this->render('AppBundle:Team:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/team/editTeam/{id}")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id,Request $request)
    {
        $team=$this->getDoctrine()->getRepository("AppBundle:Team")->find($id);
        $form=$this->createFormBuilder($team)
            ->add('name',TextType::class, array(
                "label" => "Team name",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('league',TextType::class, array(
                "label" => "League",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('country',TextType::class, array(
                "label" => "Country",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('logo',TextType::class, array(
                "label" => "Logo",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('homeArena',TextType::class, array(
                "label" => "Home Arena",
                "attr" => array(
                    'class' => 'form-control'
                )
            ))
            ->add('submit', SubmitType::class,array(
                'label'=> 'Submit',
                'attr' => array(
                    'class' => 'btn btn-success'
                ))) ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $name=$form['name']->getData();
            $league=$form['league']->getData();
            $country=$form['country']->getData();
            $logo=$form['logo']->getData();
            $homeArena=$form['homeArena']->getData();

            $team->setName($name);
            $team->setLeague($league);
            $team->setCountry($country);
            $team->setLogo($logo);
            $team->setHomeArena($homeArena);

            $em=$this->getDoctrine()->getManager();

            $em->persist($team);

            $em->flush();

            return $this->redirectToRoute("teams");
        }
        return $this->render('AppBundle:Team:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/team/deleteTeam/{id}")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $team=$this->getDoctrine()->getRepository("AppBundle:Team")->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($team);
        $em->flush();
        return $this->redirectToRoute("teams");
    }

    /**
     * @Route("/indexTeam")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($id)
    {
        $team=$this->getDoctrine()
            ->getRepository("AppBundle:Team")->find($id);

        $form=$this->createFormBuilder($team)
            ->add('name', TextareaType::class,array("label"=> "Name",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->add('logo', TextareaType::class,array("label"=> "Logo",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->add('league', TextareaType::class,array("label"=> "League",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->add('country', TextareaType::class,array("label"=> "Country",'label_attr'=>array(
                'class' => 'labelinput'
            ),'attr' => array(
                'class' =>"form-control"
            )))
            ->getForm();
        return $this->render('AppBundle:Team:info_team.html.twig', array(
            'form' => $form->createView()
        ));
    }

}

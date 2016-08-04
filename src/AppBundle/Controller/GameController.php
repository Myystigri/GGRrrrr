<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    /**
     * @Route("/game", name="game")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/game.html.twig');
    }

    /**
     * @Route("/challengelist", name="challengelist")
     */
    public function challengeListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $challenges = $em->getRepository('AppBundle:Challenge')->findAll();

        return $this->render('default/challengelist.html.twig', array(
            'challenges' => $challenges,
        ));
    }
}

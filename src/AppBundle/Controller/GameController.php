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
     * @Route("/pregame", name="pregame")
     */
    public function pregameAction()
    {
        $em = $this->getDoctrine()->getManager();
        $challenge = $em->getRepository('AppBundle:Challenge')->findOneById(1);
        $coords = $challenge->getCoords();

        return $this->render('default/pregame.html.twig', array(
            'coords' => $coords,
        ));
    }
}

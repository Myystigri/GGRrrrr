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
        $em = $this->getDoctrine()->getManager();
        $coords = $em->getRepository('AppBundle:Challenge')->findOneById(1);
        dump($coords);

        // replace this example code with whatever you need
        return $this->render('default/game.html.twig');
    }
}

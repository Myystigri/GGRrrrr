<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    /**
     * @Route("/game/{id}", name="game")
     */
    public function gameAction($id)
    {
        // replace this example code with whatever you need
        return $this->render('default/game.html.twig', array('id'=>$id));
    }

    /**
     * @Route("/challengelist", name="challengelist")
     */
    public function challengeListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $challenges = $em->getRepository('AppBundle:Challenge')->findAll();
        dump($challenges);
        return $this->render('default/challengelist.html.twig', array(
            'challenges' => $challenges,
        ));
    }

    /**
     * @Route("/score", options = { "expose" = true }, name="scoring")
     */
    public function scoreAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $score = $request->request->get('score');
            $idChallenge = $request->request->get('id');
            $response = new Response($score);
            return $response;
        }
    }
}

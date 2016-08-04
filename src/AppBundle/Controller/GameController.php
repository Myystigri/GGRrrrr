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
        dump($challenges);
        return $this->render('default/challengelist.html.twig', array(
            'challenges' => $challenges,
        ));
    }

    /**
     * @Route("/score", name="scoring")
     */
    public function scoreAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {

            $latitude = $request->request->get('lat');
            $longitude = $request->request->get('lng');
            $radius = 10;
        
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new GetSetMethodNormalizer());
            $serializer = new Serializer($normalizers, $encoders);

            $em = $this->getDoctrine()->getManager();

            $repository = $em->getRepository('WCSPropertyBundle:Professionnel');

            $LatLng = $repository->getLatLng($latitude, $longitude, $radius);
            
            $resultat = $serializer->serialize( $LatLng, 'json');

            $response = new Response($resultat);

            $response->headers->set('Content-Type', 'application/json');

            return $response;

        }
    }
}

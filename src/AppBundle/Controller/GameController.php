<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

use AppBundle\Entity\Score;

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

        $votes = $em->getRepository('AppBundle:Vote')->findAll();
        return $this->render('default/challengelist.html.twig', array(
            'challenges' => $challenges,
            'votes' => $votes
        ));
    }

    /**
     * @Route("/score/new", options = { "expose" = true }, name="scoreNew")
     */
    public function scoreNewAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $totalScore = $request->request->get('score');
            $idChallenge = $request->request->get('id');
            $scores = $em->getRepository('AppBundle:Score')->findOneBy(array('idChallenge' => $idChallenge, 'idUser'=> $user));

            if (!empty($user)){
                if (!empty($scores)) {
                    $oldScore=$scores->getScore();
                    if ($oldScore<$totalScore){
                        $scores->setScore($totalScore);

                        $em->persist($scores);
                        $em->flush();
                    }
                }
                else {

                    $score = new Score();
                    $challenge = $em->getRepository('AppBundle:Challenge')->findOneById($idChallenge);

                    $score->setScore($totalScore);
                    $score->setIdChallenge($challenge);
                    $score->setIdUser($user);

                    $em->persist($score);
                    $em->flush();
                }
            }
            else {
            }
            return new Response(
                'toto'
            );
        }
    }

    /**
     * @Route("/score", options = { "expose" = true }, name="scoreList")
     */
    public function scoreListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $challenges = $em->getRepository('AppBundle:Challenge')->findAll();

        return $this->render('default/scoreList.html.twig', array('challenges'=>$challenges));
    }

    /**
     * @Route("/score/{id}", options = { "expose" = true }, name="score")
     */
    public function scoreAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $challenges = $em->getRepository('AppBundle:Challenge')->findOneById($id);
        $scores = $em->getRepository('AppBundle:Score')->findByidChallenge($challenges);

        return $this->render('default/score.html.twig', array('scores'=>$scores, 'id'=>$id));
    }
}

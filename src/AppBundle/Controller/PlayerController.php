<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Player controller.
 *
 * @Route("/player")
 */
class PlayerController extends Controller
{
    /**
     * Lists all player entities.
     *
     * @Route("/", name="player_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $players = $em->getRepository('AppBundle:Player')->findAll();

        return $this->render('player/index.html.twig', array(
            'players' => $players,
        ));
    }



    /**
     * Finds and displays a player entity.
     *
     * @Route("/{id}", name="player_show")
     * @Method("GET")
     */
    public function showAction(Player $player)
    {

        return $this->render('player/show.html.twig', array(
            'player' => $player,
        ));
    }
}

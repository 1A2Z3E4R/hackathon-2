<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

/**
 * Team controller.
 *
 * @Route("team")
 */
class TeamController extends Controller
{
    /**
     * Lists all team entities.
     *
     * @Route("/", name="team_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tab=array();
        $teams = $em->getRepository('AppBundle:Team')->findAll();
        foreach ($teams as $key =>  $team) {
            $tab[$key]['team']=$team;
            $tab[$key]['country']=Intl::getRegionBundle()->getCountryName($team->getCountry());
        }

        return $this->render('visitor/team/index.html.twig', array(
            'tabs' => $tab,
        ));
    }

    /**
     * Finds and displays a team entity.
     *
     * @Route("/{id}", name="team_show")
     * @Method("GET")
     */
    public function showAction(Team $team)
    {
        return $this->render('visitor/team/show.html.twig', [
            'team' => $team,
        ]);
    }

}

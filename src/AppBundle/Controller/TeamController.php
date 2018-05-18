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


        return $this->render('team/index.html.twig', [
            'teams' => $teams,
        ]);
        return $this->render('team/index.html.twig', array(
            'tabs' => $tab,
        ));
    }

    /**
     * Creates a new team entity.
     *
     * @Route("/new", name="admin_team_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $team = new Team();
        $form = $this->createForm('AppBundle\Form\TeamType', $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('admin_team_show', array('id' => $team->getId()));
        }

        return $this->render('team/new.html.twig', array(
            'team' => $team,
            'form' => $form->createView(),
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
        return $this->render('team/show.html.twig', [
            'team' => $team,
        ]);
    }

}

<?php

namespace Achie\FrontendBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Achie\FrontendBundle\Entity\Event;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    /**
     * Lists all Event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AchieFrontendBundle:Event')->findAll();

        return $this->render('AchieFrontendBundle:Event:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Event entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        return $this->render('AchieFrontendBundle:Event:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}

<?php

namespace Achie\FrontendBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Achie\FrontendBundle\Entity\Request;

/**
 * Request controller.
 *
 */
class RequestController extends Controller
{

    /**
     * Lists all Request entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AchieFrontendBundle:Request')->findAll();

        return $this->render('AchieFrontendBundle:Request:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Request entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Request')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Request entity.');
        }

        return $this->render('AchieFrontendBundle:Request:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}

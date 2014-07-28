<?php

namespace Achie\FrontendBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Achie\FrontendBundle\Entity\AchievementLevel;

/**
 * AchievementLevel controller.
 *
 */
class AchievementLevelController extends Controller
{

    /**
     * Lists all AchievementLevel entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AchieFrontendBundle:AchievementLevel')->findAll();

        return $this->render('AchieFrontendBundle:AchievementLevel:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a AchievementLevel entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:AchievementLevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AchievementLevel entity.');
        }

        return $this->render('AchieFrontendBundle:AchievementLevel:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}

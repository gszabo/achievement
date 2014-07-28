<?php

namespace Achie\FrontendBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Achie\FrontendBundle\Entity\AchievementCategory;

/**
 * AchievementCategory controller.
 *
 */
class AchievementCategoryController extends Controller
{

    /**
     * Lists all AchievementCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AchieFrontendBundle:AchievementCategory')->findAll();

        return $this->render('AchieFrontendBundle:AchievementCategory:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a AchievementCategory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:AchievementCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AchievementCategory entity.');
        }

        return $this->render('AchieFrontendBundle:AchievementCategory:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}

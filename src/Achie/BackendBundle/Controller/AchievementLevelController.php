<?php

namespace Achie\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Achie\FrontendBundle\Entity\AchievementLevel;
use Achie\BackendBundle\Form\AchievementLevelType;

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

        return $this->render('AchieBackendBundle:AchievementLevel:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new AchievementLevel entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new AchievementLevel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_achievementlevel_show', array('id' => $entity->getId())));
        }

        return $this->render('AchieBackendBundle:AchievementLevel:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a AchievementLevel entity.
    *
    * @param AchievementLevel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AchievementLevel $entity)
    {
        $form = $this->createForm(new AchievementLevelType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_achievementlevel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AchievementLevel entity.
     *
     */
    public function newAction()
    {
        $entity = new AchievementLevel();
        $form   = $this->createCreateForm($entity);

        return $this->render('AchieBackendBundle:AchievementLevel:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:AchievementLevel:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing AchievementLevel entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:AchievementLevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AchievementLevel entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:AchievementLevel:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a AchievementLevel entity.
    *
    * @param AchievementLevel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AchievementLevel $entity)
    {
        $form = $this->createForm(new AchievementLevelType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_achievementlevel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AchievementLevel entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:AchievementLevel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AchievementLevel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_achievementlevel_edit', array('id' => $id)));
        }

        return $this->render('AchieBackendBundle:AchievementLevel:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AchievementLevel entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AchieFrontendBundle:AchievementLevel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AchievementLevel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('achie_backend_achievementlevel'));
    }

    /**
     * Creates a form to delete a AchievementLevel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achie_backend_achievementlevel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

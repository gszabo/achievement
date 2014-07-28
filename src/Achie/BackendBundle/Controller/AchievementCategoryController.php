<?php

namespace Achie\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Achie\FrontendBundle\Entity\AchievementCategory;
use Achie\BackendBundle\Form\AchievementCategoryType;

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

        return $this->render('AchieBackendBundle:AchievementCategory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new AchievementCategory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new AchievementCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_achievementcategory_show', array('id' => $entity->getId())));
        }

        return $this->render('AchieBackendBundle:AchievementCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a AchievementCategory entity.
    *
    * @param AchievementCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AchievementCategory $entity)
    {
        $form = $this->createForm(new AchievementCategoryType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_achievementcategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AchievementCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new AchievementCategory();
        $form   = $this->createCreateForm($entity);

        return $this->render('AchieBackendBundle:AchievementCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:AchievementCategory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing AchievementCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:AchievementCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AchievementCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:AchievementCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a AchievementCategory entity.
    *
    * @param AchievementCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AchievementCategory $entity)
    {
        $form = $this->createForm(new AchievementCategoryType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_achievementcategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AchievementCategory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:AchievementCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AchievementCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_achievementcategory_edit', array('id' => $id)));
        }

        return $this->render('AchieBackendBundle:AchievementCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AchievementCategory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AchieFrontendBundle:AchievementCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AchievementCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('achie_backend_achievementcategory'));
    }

    /**
     * Creates a form to delete a AchievementCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achie_backend_achievementcategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

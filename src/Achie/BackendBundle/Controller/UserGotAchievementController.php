<?php

namespace Achie\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Achie\FrontendBundle\Entity\UserGotAchievement;
use Achie\BackendBundle\Form\UserGotAchievementType;

/**
 * UserGotAchievement controller.
 *
 */
class UserGotAchievementController extends Controller
{

    /**
     * Lists all UserGotAchievement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AchieFrontendBundle:UserGotAchievement')->findAll();

        return $this->render('AchieBackendBundle:UserGotAchievement:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new UserGotAchievement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new UserGotAchievement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_usergotachievement_show', array('id' => $entity->getId())));
        }

        return $this->render('AchieBackendBundle:UserGotAchievement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a UserGotAchievement entity.
    *
    * @param UserGotAchievement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(UserGotAchievement $entity)
    {
        $form = $this->createForm(new UserGotAchievementType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_usergotachievement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserGotAchievement entity.
     *
     */
    public function newAction()
    {
        $entity = new UserGotAchievement();
        $form   = $this->createCreateForm($entity);

        return $this->render('AchieBackendBundle:UserGotAchievement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserGotAchievement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:UserGotAchievement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserGotAchievement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:UserGotAchievement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing UserGotAchievement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:UserGotAchievement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserGotAchievement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:UserGotAchievement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserGotAchievement entity.
    *
    * @param UserGotAchievement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserGotAchievement $entity)
    {
        $form = $this->createForm(new UserGotAchievementType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_usergotachievement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserGotAchievement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:UserGotAchievement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserGotAchievement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_usergotachievement_edit', array('id' => $id)));
        }

        return $this->render('AchieBackendBundle:UserGotAchievement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserGotAchievement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AchieFrontendBundle:UserGotAchievement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserGotAchievement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('achie_backend_usergotachievement'));
    }

    /**
     * Creates a form to delete a UserGotAchievement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achie_backend_usergotachievement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

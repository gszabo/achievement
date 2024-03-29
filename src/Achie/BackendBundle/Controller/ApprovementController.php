<?php

namespace Achie\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Achie\FrontendBundle\Entity\Approvement;
use Achie\BackendBundle\Form\ApprovementType;

/**
 * Approvement controller.
 *
 */
class ApprovementController extends Controller
{

    /**
     * Lists all Approvement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AchieFrontendBundle:Approvement')->findAll();

        return $this->render('AchieBackendBundle:Approvement:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Approvement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Approvement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_approvement_show', array('id' => $entity->getId())));
        }

        return $this->render('AchieBackendBundle:Approvement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Approvement entity.
    *
    * @param Approvement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Approvement $entity)
    {
        $form = $this->createForm(new ApprovementType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_approvement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Approvement entity.
     *
     */
    public function newAction()
    {
        $entity = new Approvement();
        $form   = $this->createCreateForm($entity);

        return $this->render('AchieBackendBundle:Approvement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Approvement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Approvement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Approvement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:Approvement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Approvement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Approvement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Approvement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:Approvement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Approvement entity.
    *
    * @param Approvement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Approvement $entity)
    {
        $form = $this->createForm(new ApprovementType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_approvement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Approvement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Approvement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Approvement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_approvement_edit', array('id' => $id)));
        }

        return $this->render('AchieBackendBundle:Approvement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Approvement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AchieFrontendBundle:Approvement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Approvement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('achie_backend_approvement'));
    }

    /**
     * Creates a form to delete a Approvement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achie_backend_approvement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

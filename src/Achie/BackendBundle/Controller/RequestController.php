<?php

namespace Achie\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Achie\FrontendBundle\Entity\Request as RequestObject;
use Achie\BackendBundle\Form\RequestType;

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

        return $this->render('AchieBackendBundle:Request:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Request entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new RequestObject();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_request_show', array('id' => $entity->getId())));
        }

        return $this->render('AchieBackendBundle:Request:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Request entity.
    *
    * @param Request $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Request $entity)
    {
        $form = $this->createForm(new RequestType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_request_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Request entity.
     *
     */
    public function newAction()
    {
        $entity = new RequestObject();
        $form   = $this->createCreateForm($entity);

        return $this->render('AchieBackendBundle:Request:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:Request:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Request entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Request')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Request entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieBackendBundle:Request:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Request entity.
    *
    * @param Request $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Request $entity)
    {
        $form = $this->createForm(new RequestType(), $entity, array(
            'action' => $this->generateUrl('achie_backend_request_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Request entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Request')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Request entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('achie_backend_request_edit', array('id' => $id)));
        }

        return $this->render('AchieBackendBundle:Request:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Request entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AchieFrontendBundle:Request')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Request entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('achie_backend_request'));
    }

    /**
     * Creates a form to delete a Request entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achie_backend_request_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

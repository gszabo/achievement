<?php

namespace Achie\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Achie\FrontendBundle\Entity\Achievement;
use Achie\FrontendBundle\Entity\Request as RequestObject;
use Achie\FrontendBundle\Form\AchievementType;

/**
 * Event controller.
 *
 */
class AchievementController extends Controller
{

    /**
     * Creates a new Achievement entity.
     *
     */
    public function newAction()
    {
        $entity = new Achievement();
        $form = $this->createForm(new AchievementType(), $entity, array(
            'action' => $this->generateUrl('achie_frontend_achievement_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Létrehoz'));

        return $this->render('AchieFrontendBundle:Achievement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function createAction(Request $request)
    {
        $entity = new Achievement();
        $form = $this->createForm(new AchievementType(), $entity, array(
            'action' => $this->generateUrl('achie_frontend_achievement_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Létrehoz'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $this->get('security.context')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();
            $entity->setCreatedAt(new \DateTime());
            $entity->setCreatedBy($user);
            $em->persist($entity);
            $request = new RequestObject();
            $request->setCreatedAt(new \DateTime());
            $request->setCreatedBy($user);
            $request->setAchievement($entity);
            $em->persist($request);
            $em->flush();

            return $this->redirect($this->generateUrl('achie_frontend_achievement_show', array('id' => $entity->getId())));
        }

        return $this->render('AchieFrontendBundle:Achievement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays an Achievement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Achievement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Achievement entity.');
        }

        return $this->render('AchieFrontendBundle:Achievement:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
    
    
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Achievement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Achievement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AchieFrontendBundle:Achievement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Achievement entity.
    *
    * @param Achievement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Achievement $entity)
    {
        $form = $this->createForm(new AchievementType(), $entity, array(
            'action' => $this->generateUrl('achie_frontend_achievement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Módosítás'));

        return $form;
    }
    /**
     * Edits an existing Achievement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AchieFrontendBundle:Achievement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Achievement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('achie_frontend_achievement_edit', array('id' => $id)));
        }

        return $this->render('AchieFrontendBundle:Achievement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Achievement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AchieFrontendBundle:Achievement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Achievement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('achie_frontend_achievement'));
    }

    /**
     * Creates a form to delete a Achievement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achie_frontend_achievement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Törlés'))
            ->getForm()
        ;
    }

}

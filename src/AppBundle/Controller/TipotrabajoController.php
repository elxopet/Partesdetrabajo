<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Tipotrabajo;
use AppBundle\Form\TipotrabajoType;

/**
 * Tipotrabajo controller.
 *
 * @Route("/tipotrabajo")
 */
class TipotrabajoController extends Controller
{

    /**
     * Lists all Tipotrabajo entities.
     *
     * @Route("/", name="tipotrabajo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Tipotrabajo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Tipotrabajo entity.
     *
     * @Route("/", name="tipotrabajo_create")
     * @Method("POST")
     * @Template("AppBundle:Tipotrabajo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Tipotrabajo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipotrabajo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Tipotrabajo entity.
     *
     * @param Tipotrabajo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tipotrabajo $entity)
    {
        $form = $this->createForm(new TipotrabajoType(), $entity, array(
            'action' => $this->generateUrl('tipotrabajo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Tipotrabajo entity.
     *
     * @Route("/new", name="tipotrabajo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Tipotrabajo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Tipotrabajo entity.
     *
     * @Route("/{id}", name="tipotrabajo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tipotrabajo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipotrabajo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Tipotrabajo entity.
     *
     * @Route("/{id}/edit", name="tipotrabajo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tipotrabajo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipotrabajo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Tipotrabajo entity.
    *
    * @param Tipotrabajo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tipotrabajo $entity)
    {
        $form = $this->createForm(new TipotrabajoType(), $entity, array(
            'action' => $this->generateUrl('tipotrabajo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Tipotrabajo entity.
     *
     * @Route("/{id}", name="tipotrabajo_update")
     * @Method("PUT")
     * @Template("AppBundle:Tipotrabajo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tipotrabajo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipotrabajo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipotrabajo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Tipotrabajo entity.
     *
     * @Route("/{id}", name="tipotrabajo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Tipotrabajo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tipotrabajo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipotrabajo'));
    }

    /**
     * Creates a form to delete a Tipotrabajo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipotrabajo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

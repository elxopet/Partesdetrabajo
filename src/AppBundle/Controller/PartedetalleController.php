<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Partedetalle;
use AppBundle\Form\PartedetalleType;

/**
 * Partedetalle controller.
 *
 * @Route("/partedetalle")
 */
class PartedetalleController extends Controller
{

    /**
     * Lists all Partedetalle entities.
     *
     * @Route("/", name="partedetalle")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Partedetalle')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Partedetalle entity.
     *
     * @Route("/", name="partedetalle_create")
     * @Method("POST")
     * @Template("AppBundle:Partedetalle:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Partedetalle();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('partedetalle_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Partedetalle entity.
     *
     * @param Partedetalle $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Partedetalle $entity)
    {
        $form = $this->createForm(new PartedetalleType(), $entity, array(
            'action' => $this->generateUrl('partedetalle_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Partedetalle entity.
     *
     * @Route("/new", name="partedetalle_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Partedetalle();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Partedetalle entity.
     *
     * @Route("/{id}", name="partedetalle_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Partedetalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partedetalle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Partedetalle entity.
     *
     * @Route("/{id}/edit", name="partedetalle_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Partedetalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partedetalle entity.');
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
    * Creates a form to edit a Partedetalle entity.
    *
    * @param Partedetalle $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Partedetalle $entity)
    {
        $form = $this->createForm(new PartedetalleType(), $entity, array(
            'action' => $this->generateUrl('partedetalle_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Partedetalle entity.
     *
     * @Route("/{id}", name="partedetalle_update")
     * @Method("PUT")
     * @Template("AppBundle:Partedetalle:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Partedetalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partedetalle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('partedetalle_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Partedetalle entity.
     *
     * @Route("/{id}", name="partedetalle_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Partedetalle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Partedetalle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('partedetalle'));
    }

    /**
     * Creates a form to delete a Partedetalle entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('partedetalle_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

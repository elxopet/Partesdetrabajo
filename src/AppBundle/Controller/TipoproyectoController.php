<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Tipoproyecto;
use AppBundle\Form\TipoproyectoType;

/**
 * Tipoproyecto controller.
 *
 * @Route("/tipoproyecto")
 */
class TipoproyectoController extends Controller
{

    /**
     * Lists all Tipoproyecto entities.
     *
     * @Route("/", name="tipoproyecto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Tipoproyecto')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Tipoproyecto entity.
     *
     * @Route("/", name="tipoproyecto_create")
     * @Method("POST")
     * @Template("AppBundle:Tipoproyecto:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Tipoproyecto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipoproyecto_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Tipoproyecto entity.
     *
     * @param Tipoproyecto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tipoproyecto $entity)
    {
        $form = $this->createForm(new TipoproyectoType(), $entity, array(
            'action' => $this->generateUrl('tipoproyecto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Tipoproyecto entity.
     *
     * @Route("/new", name="tipoproyecto_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Tipoproyecto();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Tipoproyecto entity.
     *
     * @Route("/{id}", name="tipoproyecto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tipoproyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipoproyecto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Tipoproyecto entity.
     *
     * @Route("/{id}/edit", name="tipoproyecto_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tipoproyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipoproyecto entity.');
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
    * Creates a form to edit a Tipoproyecto entity.
    *
    * @param Tipoproyecto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tipoproyecto $entity)
    {
        $form = $this->createForm(new TipoproyectoType(), $entity, array(
            'action' => $this->generateUrl('tipoproyecto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Tipoproyecto entity.
     *
     * @Route("/{id}", name="tipoproyecto_update")
     * @Method("PUT")
     * @Template("AppBundle:Tipoproyecto:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tipoproyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipoproyecto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipoproyecto_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Tipoproyecto entity.
     *
     * @Route("/{id}", name="tipoproyecto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Tipoproyecto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tipoproyecto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipoproyecto'));
    }

    /**
     * Creates a form to delete a Tipoproyecto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoproyecto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

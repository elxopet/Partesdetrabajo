<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Partecabecera;
use AppBundle\Form\PartecabeceraType;

/**
 * Partecabecera controller.
 *
 * @Route("/partecabecera")
 */
class PartecabeceraController extends Controller
{

    /**
     * Lists all Partecabecera entities.
     *
     * @Route("/", name="partecabecera")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Partecabecera')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Partecabecera entity.
     *
     * @Route("/", name="partecabecera_create")
     * @Method("POST")
     * @Template("AppBundle:Partecabecera:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Partecabecera();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('partecabecera_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Partecabecera entity.
     *
     * @param Partecabecera $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Partecabecera $entity)
    {
        $form = $this->createForm(new PartecabeceraType(), $entity, array(
            'action' => $this->generateUrl('partecabecera_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Partecabecera entity.
     *
     * @Route("/new", name="partecabecera_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Partecabecera();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Partecabecera entity.
     *
     * @Route("/{id}", name="partecabecera_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Partecabecera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partecabecera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Partecabecera entity.
     *
     * @Route("/{id}/edit", name="partecabecera_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Partecabecera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partecabecera entity.');
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
    * Creates a form to edit a Partecabecera entity.
    *
    * @param Partecabecera $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Partecabecera $entity)
    {
        $form = $this->createForm(new PartecabeceraType(), $entity, array(
            'action' => $this->generateUrl('partecabecera_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Partecabecera entity.
     *
     * @Route("/{id}", name="partecabecera_update")
     * @Method("PUT")
     * @Template("AppBundle:Partecabecera:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Partecabecera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Partecabecera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('partecabecera_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Partecabecera entity.
     *
     * @Route("/{id}", name="partecabecera_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Partecabecera')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Partecabecera entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('partecabecera'));
    }

    /**
     * Creates a form to delete a Partecabecera entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('partecabecera_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

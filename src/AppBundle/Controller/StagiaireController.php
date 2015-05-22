<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Stagiaire;
use AppBundle\Form\StagiaireType;

/**
 * Stagiaire controller.
 *
 * @Route("/stagiaire")
 */
class StagiaireController extends Controller
{

    /**
     * Lists all Stagiaire entities.
     *
     * @Route("/", name="stagiaire")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Stagiaire')->findAllWithEntreprise();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Stagiaire entity.
     *
     * @Route("/", name="stagiaire_create")
     * @Method("POST")
     * @Template("AppBundle:Stagiaire:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Stagiaire();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stagiaire_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Stagiaire entity.
     *
     * @param Stagiaire $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Stagiaire $entity)
    {
        $form = $this->createForm(new StagiaireType(), $entity, array(
            'action' => $this->generateUrl('stagiaire_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Stagiaire entity.
     *
     * @Route("/new", name="stagiaire_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Stagiaire();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Stagiaire entity.
     *
     * @Route("/{id}", name="stagiaire_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Stagiaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Stagiaire entity.
     *
     * @Route("/{id}/edit", name="stagiaire_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Stagiaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
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
    * Creates a form to edit a Stagiaire entity.
    *
    * @param Stagiaire $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Stagiaire $entity)
    {
        $form = $this->createForm(new StagiaireType(), $entity, array(
            'action' => $this->generateUrl('stagiaire_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Stagiaire entity.
     *
     * @Route("/{id}", name="stagiaire_update")
     * @Method("PUT")
     * @Template("AppBundle:Stagiaire:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Stagiaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stagiaire_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Stagiaire entity.
     *
     * @Route("/{id}", name="stagiaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Stagiaire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stagiaire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stagiaire'));
    }

    /**
     * Creates a form to delete a Stagiaire entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stagiaire_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

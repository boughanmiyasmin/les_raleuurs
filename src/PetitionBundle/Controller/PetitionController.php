<?php

namespace PetitionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PetitionBundle\Entity\Petition;
use PetitionBundle\Form\PetitionType;

/**
 * Petition controller.
 *
 * @Route("/admin/petition")
 */
class PetitionController extends Controller
{
    /**
     * Lists all Petition entities.
     *
     * @Route("/", name="petition_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $petitions = $em->getRepository('PetitionBundle:Petition')->findAll();

        return $this->render('petition/index.html.twig', array(
            'petitions' => $petitions,
        ));
    }

    /**
     * Creates a new Petition entity.
     *
     * @Route("/nouveau", name="petition_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $petition = new Petition();
        $form = $this->createForm('PetitionBundle\Form\PetitionType', $petition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $petition->setUser($this->get('security.token_storage')->getToken()->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($petition);
            $em->flush();

            return $this->redirectToRoute('petition_show', array('id' => $petition->getId()));
        }

        return $this->render('petition/new.html.twig', array(
            'petition' => $petition,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Petition entity.
     *
     * @Route("/{id}", name="petition_show")
     * @Method("GET")
     */
    public function showAction(Petition $petition)
    {
        $deleteForm = $this->createDeleteForm($petition);

        return $this->render('petition/show.html.twig', array(
            'petition' => $petition,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Petition entity.
     *
     * @Route("/{id}/modifier", name="petition_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Petition $petition)
    {
        $deleteForm = $this->createDeleteForm($petition);
        $editForm = $this->createForm('PetitionBundle\Form\PetitionType', $petition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($petition);
            $em->flush();

            return $this->redirectToRoute('petition_edit', array('id' => $petition->getId()));
        }

        return $this->render('petition/edit.html.twig', array(
            'petition' => $petition,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Petition entity.
     *
     * @Route("/{id}", name="petition_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Petition $petition)
    {
        $form = $this->createDeleteForm($petition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($petition);
            $em->flush();
        }

        return $this->redirectToRoute('petition_index');
    }

    /**
     * Creates a form to delete a Petition entity.
     *
     * @param Petition $petition The Petition entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Petition $petition)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('petition_delete', array('id' => $petition->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

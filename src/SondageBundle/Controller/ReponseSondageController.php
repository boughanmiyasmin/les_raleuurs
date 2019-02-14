<?php

namespace SondageBundle\Controller;

use SondageBundle\Entity\ReponseSondage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reponsesondage controller.
 *
 * @Route("admin/reponsesondage")
 */
class ReponseSondageController extends Controller
{
    /**
     * Lists all reponseSondage entities.
     *
     * @Route("/", name="reponsesondage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reponseSondages = $em->getRepository('SondageBundle:ReponseSondage')->findAll();

        return $this->render('reponsesondage/index.html.twig', array(
            'reponseSondages' => $reponseSondages,
        ));
    }

    /**
     * Creates a new reponseSondage entity.
     *
     * @Route("/nouveau", name="reponsesondage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reponseSondage = new Reponsesondage();
        $form = $this->createForm('SondageBundle\Form\ReponseSondageType', $reponseSondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reponseSondage);
            $em->flush();

            return $this->redirectToRoute('reponsesondage_show', array('id' => $reponseSondage->getId()));
        }

        return $this->render('reponsesondage/new.html.twig', array(
            'reponseSondage' => $reponseSondage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reponseSondage entity.
     *
     * @Route("/{id}", name="reponsesondage_show")
     * @Method("GET")
     */
    public function showAction(ReponseSondage $reponseSondage)
    {
        $deleteForm = $this->createDeleteForm($reponseSondage);

        return $this->render('reponsesondage/show.html.twig', array(
            'reponseSondage' => $reponseSondage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reponseSondage entity.
     *
     * @Route("/{id}/edit", name="reponsesondage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ReponseSondage $reponseSondage)
    {
        $deleteForm = $this->createDeleteForm($reponseSondage);
        $editForm = $this->createForm('SondageBundle\Form\ReponseSondageType', $reponseSondage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reponsesondage_edit', array('id' => $reponseSondage->getId()));
        }

        return $this->render('reponsesondage/edit.html.twig', array(
            'reponseSondage' => $reponseSondage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reponseSondage entity.
     *
     * @Route("/{id}", name="reponsesondage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ReponseSondage $reponseSondage)
    {
        $form = $this->createDeleteForm($reponseSondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reponseSondage);
            $em->flush();
        }

        return $this->redirectToRoute('reponsesondage_index');
    }

    /**
     * Creates a form to delete a reponseSondage entity.
     *
     * @param ReponseSondage $reponseSondage The reponseSondage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReponseSondage $reponseSondage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reponsesondage_delete', array('id' => $reponseSondage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

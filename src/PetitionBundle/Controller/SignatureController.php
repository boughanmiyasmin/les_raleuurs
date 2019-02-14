<?php

namespace PetitionBundle\Controller;

use PetitionBundle\Entity\Petition;
use PetitionBundle\Entity\Signature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Signature controller.
 *
 * @Route("signature")
 */
class SignatureController extends Controller
{
    /**
     * Lists all signature entities.
     *
     * @Route("/", name="signature_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $signatures = $em->getRepository('PetitionBundle:Signature')->findAll();

        return $this->render('signature/index.html.twig', array(
            'signatures' => $signatures,
        ));
    }

    /**
     * Creates a new signature entity.
     *
     *
     * @Route("/nouveau", name="signature_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newAction($id , Request $request)
    {
        $signature = new Signature();
        $form = $this->createForm('PetitionBundle\Form\SignatureType', $signature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($signature);
            $em->flush();

            return $this->redirectToRoute('signature_show', array('id' => $signature->getId()));
        }

        return $this->render('signature/new.html.twig', array(
            'signature' => $signature,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a signature entity.
     *
     * @Route("/{id}", name="signature_show")
     * @Method("GET")
     */
    public function showAction(Signature $signature)
    {
        $deleteForm = $this->createDeleteForm($signature);

        return $this->render('signature/show.html.twig', array(
            'signature' => $signature,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing signature entity.
     *
     * @Route("/{id}/modifier", name="signature_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Signature $signature)
    {
        $deleteForm = $this->createDeleteForm($signature);
        $editForm = $this->createForm('PetitionBundle\Form\SignatureType', $signature);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('signature_edit', array('id' => $signature->getId()));
        }

        return $this->render('signature/edit.html.twig', array(
            'signature' => $signature,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a signature entity.
     *
     * @Route("/{id}", name="signature_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Signature $signature)
    {
        $form = $this->createDeleteForm($signature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($signature);
            $em->flush();
        }

        return $this->redirectToRoute('signature_index');
    }

    /**
     * Creates a form to delete a signature entity.
     *
     * @param Signature $signature The signature entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Signature $signature)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('signature_delete', array('id' => $signature->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }




}

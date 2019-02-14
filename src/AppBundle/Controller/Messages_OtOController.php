<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Messages_OtO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Messages_oto controller.
 *
 * @Route("messages_oto")
 */
class Messages_OtOController extends Controller
{
    /**
     * Lists all messages_OtO entities.
     *
     * @Route("/", name="messages_oto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages_OtOs = $em->getRepository('AppBundle:Messages_OtO')->findAll();

        return $this->render('messages_oto/index.html.twig', array(
            'messages_OtOs' => $messages_OtOs,
        ));
    }

    /**
     * Creates a new messages_OtO entity.
     *
     * @Route("/nouveau", name="messages_oto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $messages_OtO = new Messages_oto();
        $form = $this->createForm('AppBundle\Form\Messages_OtOType', $messages_OtO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($messages_OtO);
            $em->flush();

            return $this->redirectToRoute('messages_oto_show', array('id' => $messages_OtO->getId()));
        }

        return $this->render('messages_oto/new.html.twig', array(
            'messages_OtO' => $messages_OtO,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a messages_OtO entity.
     *
     * @Route("/{id}", name="messages_oto_show")
     * @Method("GET")
     */
    public function showAction(Messages_OtO $messages_OtO)
    {
        $deleteForm = $this->createDeleteForm($messages_OtO);

        return $this->render('messages_oto/show.html.twig', array(
            'messages_OtO' => $messages_OtO,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing messages_OtO entity.
     *
     * @Route("/{id}/modifier", name="messages_oto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Messages_OtO $messages_OtO)
    {
        $deleteForm = $this->createDeleteForm($messages_OtO);
        $editForm = $this->createForm('AppBundle\Form\Messages_OtOType', $messages_OtO);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('messages_oto_edit', array('id' => $messages_OtO->getId()));
        }

        return $this->render('messages_oto/edit.html.twig', array(
            'messages_OtO' => $messages_OtO,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a messages_OtO entity.
     *
     * @Route("/{id}", name="messages_oto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Messages_OtO $messages_OtO)
    {
        $form = $this->createDeleteForm($messages_OtO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($messages_OtO);
            $em->flush();
        }

        return $this->redirectToRoute('messages_oto_index');
    }

    /**
     * Creates a form to delete a messages_OtO entity.
     *
     * @param Messages_OtO $messages_OtO The messages_OtO entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Messages_OtO $messages_OtO)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('messages_oto_delete', array('id' => $messages_OtO->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

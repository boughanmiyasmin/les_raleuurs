<?php

namespace SondageBundle\Controller;

use SondageBundle\Entity\Rep_question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Rep_question controller.
 *
 * @Route("rep_question")
 */
class Rep_questionController extends Controller
{
    /**
     * Lists all rep_question entities.
     *
     * @Route("/", name="rep_question_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rep_questions = $em->getRepository('SondageBundle:Rep_question')->findAll();

        return $this->render('rep_question/index.html.twig', array(
            'rep_questions' => $rep_questions,
        ));
    }

    /**
     * Finds and displays a rep_question entity.
     *
     * @Route("/{id}", name="rep_question_show")
     * @Method("GET")
     */
    public function showAction(Rep_question $rep_question)
    {

        return $this->render('rep_question/show.html.twig', array(
            'rep_question' => $rep_question,
        ));
    }
}

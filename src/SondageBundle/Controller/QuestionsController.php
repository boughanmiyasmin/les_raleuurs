<?php

namespace SondageBundle\Controller;

use SondageBundle\Entity\Questions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Question controller.
 *
 * @Route("questions")
 */
class QuestionsController extends Controller
{
    /**
     * Lists all question entities.
     *
     * @Route("/", name="questions_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $questions = $em->getRepository('SondageBundle:Questions')->findAll();

        return $this->render('questions/index.html.twig', array(
            'questions' => $questions,
        ));
    }

    /**
     * Finds and displays a question entity.
     *
     * @Route("/{id}", name="questions_show")
     * @Method("GET")
     */
    public function showAction(Questions $question)
    {

        return $this->render('questions/show.html.twig', array(
            'question' => $question,
        ));
    }
}

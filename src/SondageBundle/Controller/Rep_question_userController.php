<?php

namespace SondageBundle\Controller;

use SondageBundle\Entity\Rep_question_user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Rep_question_user controller.
 *
 * @Route("rep_question_user")
 */
class Rep_question_userController extends Controller
{
    /**
     * Lists all rep_question_user entities.
     *
     * @Route("/", name="rep_question_user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rep_question_users = $em->getRepository('SondageBundle:Rep_question_user')->findAll();

        return $this->render('rep_question_user/index.html.twig', array(
            'rep_question_users' => $rep_question_users,
        ));
    }

    /**
     * Finds and displays a rep_question_user entity.
     *
     * @Route("/{id}", name="rep_question_user_show")
     * @Method("GET")
     */
    public function showAction(Rep_question_user $rep_question_user)
    {

        return $this->render('rep_question_user/show.html.twig', array(
            'rep_question_user' => $rep_question_user,
        ));
    }
}

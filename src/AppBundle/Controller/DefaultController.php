<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use PetitionBundle\Entity\Petition;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use SondageBundle\Entity\Sondage;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Messages_OtO;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction()

    {
        $unreadMsgs = [];
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $msgRepository = $this->getDoctrine()->getRepository('AppBundle:Messages_OtO');
            $unreadMsgs =  $msgRepository->countMsgUnreadByUserID($user);
            $this->get('session')->set('unreadMsgs', $unreadMsgs[0]['cnt']);
        }

        $em = $this->getDoctrine()->getManager();

        $petitions_best = $em->getRepository('PetitionBundle:Signature')->findPetitionBySignatureCount();
        $sondages = $em->getRepository('SondageBundle:Sondage')->findAll();
        $petitions = $em->getRepository('PetitionBundle:Petition')->findAll();


        return $this->render('default/index.html.twig', array(
            'petitions' => $petitions,'petition_best'=>$petitions_best,'sondages'=>$sondages,'unreadMsgs' =>$unreadMsgs
        ));
    }
    #
    #
    #    $PetitionRepository = $this->getDoctrine()->getRepository('PetitionBundle:Petition');
    #    $petition = $PetitionRepository->findAll();
    #    // replace this example code with whatever you need
    #    return $this->render('default/index.html.twig', ['petition' => $petition,
    #        'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
    #    ]);
    #}

    /**
     * Creates a new contact entity.
     *
     * @Route("/contactez-nous", name="contact_new")
     * @Method({"GET", "POST"})
     */
    public function newAction_cn(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm('AppBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $subject =$contact->getSubject();
            $email = $contact->getEmail();
            $name = $contact->getName();
            $message = \Swift_Message::newInstance()

                ->setSubject($subject)
                ->setFrom($this->container->getParameter('mailer_user'))
                ->setTo($email)
                ->setBody($this->renderView('default/sendemail.html.twig',array('name' => $name)),'text/html');

            $this->get('mailer')->send($message);
            return $this->render('contact/contactez-nous-.html.twig');
        }

        return $this->render('contact/contactez-nous.html.twig', array(
            'contact' => $contact,
            'form' => $form->createView(),
        ));
    }



    /**
     * @Route("/conversation", name="msg_user")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function userAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $msgRepository = $this->getDoctrine()->getRepository('AppBundle:Messages_OtO');
        $allconversation  = $msgRepository->findConversationsByUserID($user);
        $unread =  $msgRepository->findMsgUnreadByUserID($user);



        return $this->render('messages_oto/conversation.html.twig', array(
            'talking_to_user_names' => $allconversation,
            'user'=> $this->get('security.token_storage')->getToken()->getUser(),
            'unread'=> $unread
        ));
    }

    /**
     * show conversation.
     *
     * @Route("/conversation/{talking_to_user_name}", name="conversation_show" , defaults={"talking_to_user_name" = 0})
     * @Method({"GET", "POST"})
     */

    public function showConversation(Request $request, $talking_to_user_name)

    {
        $msgRepository = $this->getDoctrine()->getRepository('AppBundle:Messages_OtO');
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $allConversation  = $msgRepository->findConversationsByUserID($user);
        $talking_to_user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username'=>$talking_to_user_name))->getId();
        $datetime = date('H:i:s \O\n d/m/Y');
        $msgRepository->updateMsgsTime($user, $talking_to_user, $datetime);

        $msgs = $msgRepository->findMsgByUserID($user, $talking_to_user);
        $new_messages_OtO = new Messages_oto();
        $form = $this->createForm('AppBundle\Form\Messages_user_OtOType', $new_messages_OtO);
        $form->handleRequest($request);
        $unreadMsgs =  $msgRepository->countMsgUnreadByUserID($user);
        $this->get('session')->set('unreadMsgs', $unreadMsgs[0]['cnt']);

        if ($form->isSubmitted() && $form->isValid()) {
            $new_messages_OtO ->setFromUser($this->get('security.token_storage')->getToken()->getUser());
            $new_messages_OtO ->setToUser($this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username'=>$talking_to_user_name)));

            $em = $this->getDoctrine()->getManager();
            $em->persist($new_messages_OtO);
            $em->flush();
            $status = "success";
            return new JsonResponse(array(
                'status' => $status,
                'message_from'=>$this->get('security.token_storage')->getToken()->getUser(),
                'message_content'=> $new_messages_OtO->getContent(),
                'message_time'=>$new_messages_OtO->getCreatedAt()
            ));
        }

        return $this->render('messages_oto/conversation_.html.twig', array(
            'talking_to_user_names' => $allConversation,
            'user'=> $this->get('security.token_storage')->getToken()->getUser(),
            'messages'=> $msgs,
            'new_messages_OtOn' => $new_messages_OtO,
            'form' => $form->createView(),

        ));

    }




}


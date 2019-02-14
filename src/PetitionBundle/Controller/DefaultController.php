<?php

namespace PetitionBundle\Controller;


use AppBundle\Entity\Theme;
use PetitionBundle\Entity\Petition;
use PetitionBundle\Entity\Signature;
use PetitionBundle\PetitionBundle;
use PetitionBundle\Repository\PetitionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SondageBundle\Entity\Sondage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use AppBundle\Entity\Messages_OtO;




class DefaultController extends Controller
{
    /**
     * @Route("/nos-petitions", name="Petition")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $listTheme = $em->getRepository('AppBundle:Theme')->findAll();
        $listpetition = $em->getRepository('PetitionBundle:Petition')->findAll();
        $listpetition = array_reverse($listpetition);
        $petition  = $this->get('knp_paginator')->paginate(
            $listpetition,
            $request->query->get('page', 1),6);


        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('Rechercher', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2])
                ]
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $Repository = $this->getDoctrine()->getRepository('PetitionBundle:Petition');
            $rechPetition = $Repository->findsearch($data);
            $petition  = $this->get('knp_paginator')->paginate(
                $rechPetition,
                $request->query->get('page', 1),6);
            return $this->render('PetitionBundle:Default:index.html.twig',
                ['petition' =>$petition,'themes'=>$listTheme, 'form' => $form->createview() ]);}



        return $this->render('PetitionBundle:Default:index.html.twig',
            [
                'themes'=>$listTheme,
                'petition' => $petition,
                'form' => $form->createview()
            ]);
    }

    /**
     * @Route("/nos-petitions/{theme}", name="Petition_theme")
     * @param Request $request
     * @param Theme $theme
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index_theme_Action(Request $request, Theme $theme)
    {

        $em = $this->getDoctrine()->getManager();
        $listTheme = $em->getRepository('AppBundle:Theme')->findAll();
        if($theme != null){
            $PetitionRepository = $this->getDoctrine()->getRepository('PetitionBundle:Petition');
            $listpetition = $PetitionRepository->findPetitionByThemeID($theme->getId());

        }

        else{
            $listpetition = $em->getRepository('PetitionBundle:Petition')->findAll();}
        $listpetition = array_reverse($listpetition);
        $petition  = $this->get('knp_paginator')->paginate(
            $listpetition,
            $request->query->get('page', 1),6);


        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('Rechercher', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2])
                ]
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $Repository = $this->getDoctrine()->getRepository('PetitionBundle:Petition');
            $rechPetition = $Repository->findsearch($data);
            $petition  = $this->get('knp_paginator')->paginate(
                $rechPetition,
                $request->query->get('page', 1),6);
            return $this->render('PetitionBundle:Default:index.html.twig',
                ['petition' =>$petition,'themes'=>$listTheme, 'form' => $form->createview() ]);}



        return $this->render('PetitionBundle:Default:index.html.twig',
            [
                'themes'=>$listTheme,
                'petition' => $petition,
                'form' => $form->createview()
            ]);
    }

    /**
     * @param Petition $id
     * @Method({"GET", "POST"})
     * @return Route|\Symfony\Component\HttpFoundation\Response
     * @Route("/update/{id}", name="update")
     */
    public function updateAction(Petition $id)
    {   $PetitionRepository = $this->getDoctrine()->getRepository('PetitionBundle:Petition');
        $petition = $PetitionRepository->find($id);


        $session = $this->get('session');
        $a = $session->getId();
        $post = Request::createFromGlobals();
            $pk = ($post->get("petition_q"));
            $age = ($post->get("age"));
            $msg = ($post->get("message"));
            $p = ($post->get("profession"));

        $sRepository = $this->getDoctrine()->getRepository('PetitionBundle:Signature');
        $s = $sRepository->setForm( $a, $pk, $age, $msg, $p);
        $session->invalidate();
        return $this->redirectToRoute('Signature', array('id' => $petition->getId() , 'signature' => $s));

    }

    /**
     * Creates a new Petition entity.
     *
     * @Route("/petition/{id}/nouveau_msg", name="petitionuser_new_msg")
     * @Method({"GET", "POST"})
     */
    public function new_msgAction(Petition $id, Request $request)
    {
        $session = $this->get('session');
        $session->start();

        $PetitionRepository = $this->getDoctrine()->getRepository('PetitionBundle:Petition');
        $petition = $PetitionRepository->find($id);
        $petition_user = $petition->getUser();
        $new_messages_OtO = new Messages_oto();
        $form_msg = $this->createForm('AppBundle\Form\Messages_user_OtOType', $new_messages_OtO);
        $form_msg->handleRequest($request);
        $signature = new Signature();
        $form = $this->createForm('PetitionBundle\Form\SignatureuserType', $signature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $datetime = date('H:i:s \O\n d/m/Y');
            $signature->setIdsession($session->getId());
            $signature->setComplement1($datetime);
            $signature->setPetition($id);

            $em->persist($signature);
            $em->flush();
        }

        if ($form_msg->isSubmitted() && $form_msg->isValid()) {
            $new_messages_OtO->setFromUser($this->get('security.token_storage')->getToken()->getUser());
            $new_messages_OtO->setToUser($petition_user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($new_messages_OtO);
            $em->flush();
            return $this->render('PetitionBundle:Default:info.html.twig', ['petition' => $id ,'signature' => $signature, 'message' => "success",
        'form' => $form->createView()]);

        }
        return $this->render('PetitionBundle:Default:new_msg.html.twig', ['petition' => $petition,'petition_user' => $petition_user,
            'form' => $form_msg->createView()]);
    }





    /**
     * @param Petition $id
     * @param Request $request
     * @Method({"GET", "POST"})
     * @return Route|\Symfony\Component\HttpFoundation\Response @Route("/petition/{id}", name="info_petition")
     */
    public function infoAction(Petition $id, Request $request )
    {
        $session = $this->get('session');
        $session->start();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $PetitionRepository = $this->getDoctrine()->getRepository('PetitionBundle:Petition');
        $petition = $PetitionRepository->find($id);
        $petition_user = $petition->getUser();
        $new_messages_OtO = new Messages_oto();
        $form_msg = $this->createForm('AppBundle\Form\Messages_user_OtOType', $new_messages_OtO);
        $form_msg->handleRequest($request);
        if ($form_msg->isSubmitted() && $form_msg->isValid()) {
            $new_messages_OtO->setFromUser($this->get('security.token_storage')->getToken()->getUser());
            $new_messages_OtO->setToUser($this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('username' => $petition_user)));

            $em = $this->getDoctrine()->getManager();
            $em->persist($new_messages_OtO);
            $em->flush();

        }

        $signature = new Signature();

        if ($user!="anon."){


            $signature->setNom($user->getNom());
            $signature->setPrenom($user->getPrenom());
            $signature->setMail($user->getEmail());
            $signature->setTelephone($user-> getTelephone());
            $signature->setAdresse($user->getAdresse());
            $signature->setVille($user->getVille());
            $signature->setCp($user->getCp());
        }


            $form = $this->createForm('PetitionBundle\Form\SignatureuserType', $signature);
            $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $datetime = date('H:i:s \O\n d/m/Y');
            $signature->setIdsession($session->getId());
            $signature->setComplement1($datetime);
            $signature->setPetition($id);

            $em->persist($signature);
            $em->flush();


        }



        return $this->render('PetitionBundle:Default:info.html.twig', ['petition' => $petition, 'message' => "null" ,
        'signature' => $signature,
        'form' => $form->createView()]);

    }


    /**
     * Creates a new Petition entity.
     *
     * @Route("/utilisateur-petitions/nouveau", name="petitionuser_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $petition = new Petition();
        $form = $this->createForm('PetitionBundle\Form\PetitionType', $petition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $petition->getImg();
            if ($file!= null){

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();


            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('imgs_directory'),
                $fileName
            );


            // updates the 'imageFile' property to store the imgfile name
            // instead of its contents
            $petition->setImg($fileName);
            }else{$petition->setImg("standard.png");}
            $petition->setUser($this->get('security.token_storage')->getToken()->getUser());
            $datetime = date('  d/m/Y \à  H:i:s');
            $petition->setcree($datetime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($petition);
            $em->flush();

            return $this->redirectToRoute('petitionuser', array('id' => $petition->getId()));
        }

        return $this->render('PetitionBundle:Default:new.html.twig', array(
            'petition' => $petition,
            'form' => $form->createView(),
        ));
    }
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * Finds and displays a Petition entity.
     *
     * @Route("/utilisateur-petitions/{id}", name="petitionuser_show")
     * @Method("GET")
     */
    public function showAction(Petition $petition)
    {
        $deleteForm = $this->createDeleteForm($petition);

        return $this->render('PetitionBundle:Default:show.html.twig', array(
            'petition' => $petition,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Petition entity.
     *
     * @Route("/utilisateur-petitions/{id}/modifier", name="petitionuser_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Petition $petition)
    {
        $oldImg = $petition->getImg();
        $deleteForm = $this->createDeleteForm($petition);
        $editForm = $this->createForm('PetitionBundle\Form\PetitionType', $petition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /** @var UploadedFile $file */
            $file = $petition->getImg();
            if ($file!= null){

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();


            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('imgs_directory'),
                $fileName
            );


            // updates the 'imageFile' property to store the imgfile name
            // instead of its contents
            $petition->setImg($fileName);}
            if ($file === null) { $petition-> setImg($oldImg); }
            $em = $this->getDoctrine()->getManager();
            $em->persist($petition);
            $em->flush();

            return $this->redirectToRoute('petitionuser', array('id' => $petition->getId()));
        }

        return $this->render('PetitionBundle:Default:edit.html.twig', array(
            'petition' => $petition,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Petition entity.
     *
     * @Route("/utilisateur-petitions/{id}", name="petitionuser_delete")
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

        return $this->redirectToRoute('petitionuser');
    }


    /**
     * @Route("/utilisateur-petitions", name="petitionuser")
     * @param  Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function userAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $PetitionRepository = $this->getDoctrine()->getRepository('PetitionBundle:Petition');
        $petition = $PetitionRepository->findPetitionByUserID($user);

        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('Rechercher', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2])
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        return $this->render('PetitionBundle:Default:user.html.twig',
            ['petition' =>$petition,'form' => $form->createView()
            ]);
    }

    private function createDeleteForm(Petition $petition)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('petitionuser_delete', array('id' => $petition->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * @param  Petition $id
     * @param Request $request
     * @Method({"GET", "POST"})
     * @return Route|\Symfony\Component\HttpFoundation\Response
     * @Route("/signatures/{id}", name="Signature")
     */
    public function signatureAction($id,Request $request)
    {

        $PetitionRepository = $this->getDoctrine()->getRepository('PetitionBundle:Petition');
        $petition = $PetitionRepository->findOneBy(array('id'=>$id))->getNom();
        $SignatureRepository = $this->getDoctrine()->getRepository('PetitionBundle:Signature');
        $signature = $SignatureRepository->findSignatureByPetitionID($id);
        if ($signature!= null){
            $petition_user = $signature[0]->getPetition()->getUser();
        }

        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('Rechercher', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2])
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted($request) && $form->isValid()) {

            die ('Form submitted');}
        return $this->render('PetitionBundle:Default:signature.html.twig',
            ['signature' =>$signature,'user' => $petition_user,'petition_id'=>$id,"petition_name" =>$petition,
                'form' => $form->createview()
            ]);
    }

    /**
     * @param  Petition $id
     * @Route("/signatures_ex/{id}", name="Signature_ex")
     */
    public function exportAction( $id)

    {
        $PetitionRepository = $this->getDoctrine()->getRepository('PetitionBundle:Signature');
        $signatures = $PetitionRepository->findBy(array('petition' => $id));

        $writer = $this->container->get('egyg33k.csv.writer');
        $csv = $writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Prenom', 'Nom', 'email', 'Telephone', 'ville', 'Code postal', 'age', 'profession']);

        foreach ($signatures as $p){
            $csv->insertOne(array($p->getPrenom(), $p->getNom(), $p->getMail(), $p->getTelephone(), $p->getVille(), $p->getCp(), $p->getAge(), $p->getProfession()));
        }
        $csv->output('users.csv');
        die('export');
    }


}


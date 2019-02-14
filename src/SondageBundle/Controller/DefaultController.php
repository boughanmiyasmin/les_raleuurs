<?php

namespace SondageBundle\Controller;

use SondageBundle\Entity\Sondage;
use SondageBundle\Form\SondageType;

use SondageBundle\Entity\Choix;
use SondageBundle\Form\ChoixType;

use SondageBundle\Entity\Participation;
use SondageBundle\Entity\ReponseQuestion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Theme;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use SondageBundle\Repository\SondageRepository;
use Ob\HighchartsBundle\Highcharts\AbstractChart;
use Ob\HighchartsBundle\Highcharts\ChartOption;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Ob\HighchartsBundle\Highcharts\Highstock;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class DefaultController extends Controller
{
    /**
     * @Route("/nos-sondages", name="sondage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $listTheme = $em->getRepository('AppBundle:Theme')->findAll();
        $listsondage = $em->getRepository('SondageBundle:Sondage')->findAll();
        $listsondage = array_reverse($listsondage);
        $sondage  = $this->get('knp_paginator')->paginate(
            $listsondage,
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
            $Repository = $this->getDoctrine()->getRepository('SondageBundle:Sondage');
            $rechsondage = $Repository->findsearch($data);
            $sondage  = $this->get('knp_paginator')->paginate(
                $rechsondage,
                $request->query->get('page', 1),6);
            return $this->render('SondageBundle:Default:index.html.twig',
                ['sondage' =>$sondage,'themes'=>$listTheme, 'form' => $form->createview() ]);}

        if ($form->isSubmitted($request) && $form->isValid()) { die ('Form submitted');}
        return $this->render('SondageBundle:Default:index.html.twig',
            ['sondage' =>$sondage,
                'themes'=>$listTheme,
                'form' => $form->createview()
            ]);
    }


    /**
     * @Route("/nos-sondages/{theme}", name="sondage_theme")
     * @param Request $request
     * @param Theme $theme
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index_theme_Action(Request $request, Theme $theme)
    {
        $em = $this->getDoctrine()->getManager();
        $listTheme = $em->getRepository('AppBundle:Theme')->findAll();
        if($theme != null){
            $SondageRepository = $this->getDoctrine()->getRepository('SondageBundle:Sondage');
            $listsondage= $SondageRepository->findSondageByThemeID($theme->getId());

        } else{

            $listsondage = $em->getRepository('SondageBundle:Sondage')->findAll();}
        $listsondage = array_reverse($listsondage);
        $sondage  = $this->get('knp_paginator')->paginate(
            $listsondage,
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
            $Repository = $this->getDoctrine()->getRepository('SondageBundle:Sondage');
            $rechsondage = $Repository->findsearch($data);
            $sondage  = $this->get('knp_paginator')->paginate(
                $rechsondage,
                $request->query->get('page', 1),6);
            return $this->render('SondageBundle:Default:index.html.twig',
                ['sondage' =>$sondage,'themes'=>$listTheme, 'form' => $form->createview() ]);}

        if ($form->isSubmitted($request) && $form->isValid()) { die ('Form submitted');}
        return $this->render('SondageBundle:Default:index.html.twig',
            ['sondage' =>$sondage,
                'themes'=>$listTheme,
                'form' => $form->createview()
            ]);
    }

    /**
     * @param Sondage $id
     * @Method({"GET", "POST"})
     * @return Route|\Symfony\Component\HttpFoundation\Response
     * @Route("/update1/{id}", name="update1")
     */
    public function updateAction(Sondage $id)
    {
        $sondageRepository1 = $this->getDoctrine()->getRepository('SondageBundle:Sondage');
        $sondage = $sondageRepository1->find($id);
        $SondageRepository = $this->getDoctrine()->getRepository('SondageBundle:ReponseSondage');



        $session = $this->get('session');
        $a = $session->getId();
        $post = Request::createFromGlobals();
        $pk = ($post->get("sondage_q"));
        $age = ($post->get("age"));
        $msg = ($post->get("message"));
        $p = ($post->get("profession"));


        $sondage2 = $SondageRepository->setForm( $a, $pk, $age, $msg, $p);
        $session->invalidate();
        return $this->render('SondageBundle:Default:info1.html.twig',
            ['id' =>$id , 'sondage' => $sondage, 'reponse' => $sondage2 ]);


    }


    /**
     * @param Sondage $id
     *
     * @Method({"GET", "POST"})
     * @return Route|\Symfony\Component\HttpFoundation\Response
     * @Route("/sondage/{id}", name="info_sondage")
     */
    public function infoAction(Sondage $id, Request $request)
    {


        $user = $this->get('security.token_storage')->getToken()->getUser();


        $em = $this->getDoctrine()->getManager();
        $sondage = $em->getRepository('SondageBundle:Sondage')->find($id);
        $questions = $sondage->getQuestions();
        $num_q = count($questions);
        $participation = new Participation($sondage);

        $form = $this->createForm(ChoixType::class, $participation->getChoix());

        // Si la requête est en POST
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            if ($user!="anon."){
                $participation->setUser($user);
            }

            $em->persist($participation);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Choix bien enregistrée.');
            return $this->render('SondageBundle:Default:info1.html.twig', array( 'sondage' => $sondage, 'num_q' => $num_q));

        }
        return $this->render('SondageBundle:Default:info.html.twig', array( 'sondage' => $sondage, 'form' => $form->createview(),'num_q' => $num_q ));

    }

    /**
     * Creates a new sondage entity.
     *
     * @Route("/utilisateur-sondages/nouveau", name="sondageuser_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sondage = new Sondage();
        $form = $this->createForm('SondageBundle\Form\SondageType', $sondage);
        $session = $this->get('session');
        $sessionId = $session->getId();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            /** @var UploadedFile $file */
            $file = $sondage->getImage();

            if($file != null){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();


            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('imgs_directory'),
                $fileName
            );

            // updates the 'imageFile' property to store the imgfile name
            // instead of its contents
            $sondage->setImage($fileName);}else{$sondage->setImage("standard.png");}


            $sondage->setUser($this->get('security.token_storage')->getToken()->getUser());
            $datetime = date('  d/m/Y \à  H:i:s');
            $sondage->setDate($datetime);
            $sondage->setSessionId( $sessionId);
            $em = $this->getDoctrine()->getManager();
            $em->persist($sondage);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Sondage bien enregistrée.');
            return $this->redirectToRoute('sondageuser');
        }

        return $this->render('SondageBundle:Default:new.html.twig', array(
            'sondage' => $sondage,
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
     * Finds and displays a sondage entity.
     *
     * @Route("/nouveau-sondages/{id}", name="sondageuser_show")
     * @Method("GET")
     */
    public function showAction(Sondage $sondage)
    {
        $deleteForm = $this->createDeleteForm($sondage);

        return $this->render('SondageBundle:Default:show.html.twig', array(
            'sondage' => $sondage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sondage entity.
     *
     * @Route("/nouveau-sondages/{id}/edit", name="sondageuser_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sondage $sondage)
    {
        $deleteForm = $this->createDeleteForm($sondage);
        $editForm = $this->createForm('SondageBundle\Form\SondageType', $sondage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /** @var UploadedFile $file */
            $file = $sondage->getImage();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();


            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('imgs_directory'),
                $fileName
            );


            // updates the 'imageFile' property to store the imgfile name
            // instead of its contents
            $sondage->setImage($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sondageuser');
        }

        return $this->render('SondageBundle:Default:edit.html.twig', array(
            'sondage' => $sondage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sondage entity.
     *
     * @Route("/nouveau-sondages/{id}", name="sondageuser_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sondage $sondage)
    {
        $form = $this->createDeleteForm($sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sondage);
            $em->flush();
        }

        return $this->redirectToRoute('sondageuser');
    }

    /**
     * Creates a form to delete a sondage entity.
     *
     * @param Sondage $sondage The sondage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sondage $sondage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sondageuser_delete', array('id' => $sondage->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * @Route("/utilisateur-sondages", name="sondageuser")
     * @param  Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function userAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $SondageRepository = $this->getDoctrine()->getRepository('SondageBundle:Sondage');
        $sondage = $SondageRepository->findSondageByUserID($user);

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

        return $this->render('SondageBundle:Default:user.html.twig',
            ['sondage' =>$sondage,'form' => $form->createView()
            ]);
    }


    /**
     * @Route("/reps/{id}", name="rep")
     * @param Request $request
     * @param string $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function chartAction($id ,Request $request){

        $charts = array();
        $em = $this->getDoctrine()->getManager();
        $sondage = $em->getRepository('SondageBundle:Sondage')->find($id);
        $Questions = $sondage->getQuestions();
        $index = 1;
        foreach ($Questions as $question)
        {
            $data = array();
            $reponse_list = array();
            $reponsesQuestion= $question->getReponseQuestions();
            $x = (count($reponsesQuestion));
            foreach ($reponsesQuestion as $reponseQuestion)
            {
                $reponse = $reponseQuestion->getReponse()->getReponseText();
                array_push($reponse_list, $reponse);
            }


            $cnt = array_count_values($reponse_list);

            foreach($cnt as $key => $value)
            {
                $a = array ($key, ($value*100/$x));
                array_push($data, $a);
            }

            $ob = new Highchart();
            $ob->chart->renderTo('linechart'.$index);
            $ob->title->text($question->getQuestionText());
            $ob->plotOptions->pie(array(
                'allowPointSelect'  => true,
                'cursor'    => 'pointer',
                'dataLabels'    => array($question->getQuestionText()),
                'showInLegend'  => true
            ));
            $ob->series(array(array('type' => 'pie','name' => '%', 'data' => $data )));

            $charts[]= $ob;
            $index++;



        }
        return $this->render('SondageBundle:Default:rep.html.twig',
            ['charts' =>$charts]);
    }



//
//    /**
//     * @Route("/reps/{id}", name="rep")
//     * @param Request $request
//     * @param string $id
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function chartAction($id ,Request $request)
//    {
//        $ReponseSondageRepository = $this->getDoctrine()->getRepository('SondageBundle:ReponseSondage');
//        $Reponsesondage = $ReponseSondageRepository->findRepBySondageID($id);
//
//
//
//
//
//        $ReponseSondageRepository = $this->getDoctrine()->getRepository('SondageBundle:ReponseSondage');
//        $em = $ReponseSondageRepository->findRep($id);
//
//
//        $data = array();
//
//
//        foreach ($em as $values)
//
//
//        {$x = 0;
//            foreach ($em as $v) {$x = $x + intval($v['Reps']); }
//            $SondageRepository = $this->getDoctrine()->getRepository('SondageBundle:Sondage');
//            $d = $SondageRepository->findquestion($id ,$values['Reponse']);
//
//
//            foreach ($d as $values1)
//
//            $a = array ($values1['question'], (($values['Reps']*100)/$x));
//
//
//
//
//            array_push($data, $a);
//
//        }
//
//        $ob = new Highchart();
//        $ob->chart->renderTo('linechart');
//        $ob->title->text('');
//        $ob->plotOptions->pie(array(
//            'allowPointSelect'  => true,
//            'cursor'    => 'pointer',
//            'dataLabels'    => array($d),
//            'showInLegend'  => true
//        ));

//
//
//        $ob->series(array(array('type' => 'pie','name' => '%', 'data' => $data , )));
//
//
//
//        return $this->render('SondageBundle:Default:rep.html.twig',
//            ['Reponsesondage' =>$Reponsesondage, 'chart' => $ob, 'em' =>$em]);
//    }
//


}

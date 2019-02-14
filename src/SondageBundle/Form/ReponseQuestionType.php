<?php

namespace SondageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use SondageBundle\Repository\ReponseRepository;
use SondageBundle\Entity\Reponse;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ReponseQuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) { 

            $form = $event->getForm();
            $entity = $event->getData();
            $questionId = $entity->getQuestion()->getId();
            $questionText = $entity->getQuestion()->getQuestionText();

            $form->add('reponse', EntityType::class, array(
                'label'=> $questionText,
                'class'=> 'SondageBundle:Reponse', 
                'choice_label'=>'reponseText', 
                'multiple' => false,
                'expanded' => true,
                'query_builder' => function(ReponseRepository $repository) use($questionId){
                                            return $repository->getReponseByQuestion($questionId);
                                        }
            ));
        }                             
     );
    
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SondageBundle\Entity\ReponseQuestion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sondagebundle_reponsequestion';
    }

}

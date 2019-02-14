<?php

namespace SondageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use SondageBundle\Form\ReponseQuestionType;

class ChoixType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('reponseQuestions', CollectionType::class, array(
            'entry_type' => ReponseQuestionType::class,
            'by_reference' => false,
            'allow_add' => false,
            'allow_delete' => false,
            'entry_options'=>array('label'=>false)));
                
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SondageBundle\Entity\Choix'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sondagebundle_choix';
    }


}

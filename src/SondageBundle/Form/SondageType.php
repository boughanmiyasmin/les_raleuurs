<?php

namespace SondageBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use SondageBundle\Form\QuestionType;


class SondageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author')
            ->add('theme', EntityType::class, array(
                'class'        => 'AppBundle:Theme',
                'choice_label' => 'theme',
                'multiple'     => false,
            ))
            ->add('image',FileType::class,array('data_class' => null,
                'label' => 'photo de pétition',
                'required'=> false ))
            ->add('lien',TextType::class, ['required' => false])
            ->add('titre', TextType::class, ['required' => true , 'label' => ' Insérer le titre de votre sondage'])
            ->add('text', CKEditorType::class, array('label' => 'Présenter le problème que vous voulez résoudre',
                'config' => array('toolbar' => 'full')))
            ->add('questions', CollectionType::class, array(
                'entry_type' => QuestionType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true));
        
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SondageBundle\Entity\Sondage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sondagebundle_sondage';
    }


}

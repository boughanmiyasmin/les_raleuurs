<?php

namespace PetitionBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PetitionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['required' => true , 'label' => ' Insérer le titre de votre pétition'])
            ->add('n_p', TextareaType::class,[ 'label' => ' Indiquer un destinataire'])

            ->add('theme', EntityType::class, array(
                'class'        => 'AppBundle:Theme',
                'choice_label' => 'theme',
                'multiple'     => false,
            ))
            ->add('img',FileType::class,array('data_class' => null,'translation_domain' => 'forms',
                'label' => 'photo de pétition',
                'required'=> false ))
            ->add('description', CKEditorType::class, array('label' => 'Présenter le problème que vous voulez résoudre',
                'config' => array('toolbar' => 'full')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PetitionBundle\Entity\Petition'
        ));
    }
}

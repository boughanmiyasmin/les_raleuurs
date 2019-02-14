<?php

namespace PetitionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignatureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenom')
            ->add('nom')
            ->add('mail')
            ->add('telephone')
            ->add('cp')
            ->add('annonyme')
            ->add('age')
            ->add('profession')
            ->add('message')
            ->add('engagement');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PetitionBundle\Entity\Signature'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'petitionbundle_signature';
    }


}

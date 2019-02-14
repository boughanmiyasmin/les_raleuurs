<?php
/**
 * Created by PhpStorm.
 * User: yasmin
 * Date: 12/04/18
 * Time: 15:28
 */

namespace PetitionBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Signatureuser1Type extends AbstractType
{ /**
 * {@inheritdoc}
 */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenom', TextType::class, ['required' => true, 'label' => "Prenom"])
            ->add('nom')
            ->add('mail', TextType::class, ['required' => true, 'label' => "Email"])
            ->add('telephone')
            ->add('adresse')
            ->add('ville',ChoiceType::class, array('choices' => array(
                "villes" => array(
                    "bourg"=> "bourg",
                    "laon"=> "laon",
                    "moulins"=> "moulins",
                    "digne"=> "digne",
                    "gap"=> "gap",
                    "nice"=> "nice",
                    "privas"=> "privas",
                    "charleville"=> "charleville",
                    "foix"=> "foix",
                    "troyes"=> "troyes",
                    "carcassonne"=> "carcassonne",
                    "rodez"=> "rodez",
                    "marseille"=> "marseille",
                    "caen"=> "caen",
                    "aurillac"=> "aurillac",
                    "angouleme"=> "angouleme",
                    "larochelle"=> "larochelle",
                    "bourges"=> "bourges",
                    "tulle"=> "tulle",
                    "ajaccio"=> "ajaccio",
                    "bastia"=> "bastia",
                    "dijon"=> "dijon",
                    "saintbrieuc"=> "saintbrieuc",
                    "gueret"=> "gueret",
                    "perigueux"=> "perigueux",
                    "besancon"=> "besancon",
                    "lille"=> "lille",
                    "evreux"=> "evreux",
                    "chartres"=> "chartres",
                    "quimper"=> "quimper",
                    "nimes"=> "nimes",
                    "toulouse"=> "toulouse",
                    "auch"=> "auch",
                    "bordeaux"=> "bordeaux",
                    "montpellier"=> "montpellier",
                    "rennes"=> "rennes",
                    "chateauroux"=> "chateauroux",
                    "tours"=> "tours",
                    "grenoble"=> "grenoble",
                    "lons"=> "lons",
                    "montdemarsan"=> "montdemarsan",
                    "blois"=> "blois",
                    "saintetienne"=> "saintetienne",
                    "lepuyenvelay"=> "lepuyenvelay",
                    "nantes"=> "nantes",
                    "orleans"=> "orleans",
                    "cahors"=> "cahors",
                    "agen"=> "agen",
                    "mende"=> "mende",
                    "angers"=> "angers",
                    "saintlo"=> "saintlo",
                    "chalons"=> "chalons",
                    "chaumont"=> "chaumont",
                    "laval"=> "laval",
                    "nancy"=> "nancy",
                    "barleduc"=> "barleduc",
                    "vannes"=> "vannes",
                    "metz"=> "metz",
                    "nevers"=> "nevers",
                    "lille"=> "lille",
                    "beauvais"=> "beauvais",
                    "alencon"=> "alencon",
                    "arras"=> "arras",
                    "clermont"=> "clermont",
                    "pau"=> "pau",
                    "tarbes"=> "tarbes",
                    "perpignan"=> "perpignan",
                    "strasbourg"=> "strasbourg",
                    "colmar"=> "colmar",
                    "lyon"=> "lyon",
                    "vesoul"=> "vesoul",
                    "macon"=> "macon",
                    "lemans"=> "lemans",
                    "chambery"=> "chambery",
                    "annecy"=> "annecy",
                    "paris"=> "paris",
                    "rouen"=> "rouen",
                    "melun"=> "melun",
                    "versailles"=> "versailles",
                    "niort"=> "niort",
                    "amiens"=> "amiens",
                    "albi"=> "albi",
                    "montauban"=> "montauban",
                    "toulon"=> "toulon",
                    "avignon"=> "avignon",
                    "larochesuryon"=> "larochesuryon",
                    "poitiers"=> "poitiers",
                    "limoges"=> "limoges",
                    "epinal"=> "epinal",
                    "auxerre"=> "auxerre",
                    "belfort"=> "belfort",
                    "evry"=> "evry",
                    "nanterre"=> "nanterre",
                    "bobigny"=> "bobigny",
                    "creteil"=> "creteil",
                    "pontoise"=> "pontoise"
                ))))
            ->add('cp', TextType::class, ['required' => true, 'label' => "Code postal"])
            ->add('engagement', CheckboxType::class, array('required' => false, 'data' => true))
            ->add('annonyme', CheckboxType::class, array('required' => true, 'data' => true, 'label' => "Signature publique"));

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

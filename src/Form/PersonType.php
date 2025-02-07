<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Person;
use App\Entity\Photo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class,[
                'label' => 'Prénom',
                'help' => 'Veuillez saisir votre prénom',
                'help_attr' => ['style' => 'color: red'],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom de famille',
                'attr' => ['style' => 'background: red', 'maxlength' => 12],
                'sanitize' => true,
            ])
//            ->add('adress', EntityType::class, [
//                'class' => Address::class,
//                'multiple' => false,
//                'expanded' => false,
//            ])
        ->add('address', AdresseType::class,[
            'label' => '<h3>Créer une adresse</h3>',
                'label_html' => true,
            ])
            //->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }


}


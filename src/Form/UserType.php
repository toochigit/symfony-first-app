<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', null, ['label' => 'Nom de famille'])
            ->add('firstName', null, ['label'=>'Prénom'])
            ->add('nickName', null, ['label' => 'Surnom'])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'first_options'  => ['label' => 'Email'],
                'second_options' => ['label' => 'Confirmation email'],
                'invalid_message' => "L'email et sa confirmation ne correspondent pas"
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

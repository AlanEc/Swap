<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'required'   => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Email',
                )
            ))
            ->add('first_name', TextType::class, array(
                'required'   => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Prénom',
                )
            ))
            ->add('last_name',TextType::class, array(
                'required'   => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom',
                )
            ))
            ->add('password', PasswordType::class, array(
                'required'   => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Mot de passe',
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'M\'inscrire'
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
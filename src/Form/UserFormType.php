<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\User;
use App\Entity\Image;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Form\ImageFormType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, array(
            'required'   => false,
            ))
            ->add('last_name')
            ->add('first_name')
            ->add('password')
            ->add('image', FileType::class, array(
                'label' => false,
                'required' => false,
                'data_class' => null
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
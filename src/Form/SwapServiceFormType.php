<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\SwapService;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SwapServiceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('people_quantity', ChoiceType::class, array(
                    'label' => 'Nombre de personnes max.',
                    'choices' => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8' ))
            )
            ->add('adress_1', TextType::class)
            ->add('country', TextType::class, array(
                'label' => false
            ))
            ->add('city', TextType::class, array(
                'label' => false
            ))
            ->add('postal_code', TextType::class, array(
                'label' => false
            ))
            ->add('region', TextType::class, array(
                'label' => false
            ))
            ->add('longitude', TextType::class, array(
                'label' => false
            ))
            ->add('latitude', TextType::class, array(
                'label' => false
            ))
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SwapService::class
        ]);
    }
}
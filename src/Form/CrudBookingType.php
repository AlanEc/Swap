<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CrudBookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_start', DateType::class, array(
                'label' => 'Du',
                'html5' => false,
                'widget' => 'single_text',
            ))
            ->add('date_end', DateType::class, array(
                'label' => 'Du',
                'html5' => false,
                'widget' => 'single_text',
            ))
            ->add('disabled')
            ->add('save', SubmitType::class, array(
                'label' => 'Modifier'
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}

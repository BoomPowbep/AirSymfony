<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('beginDate')
            ->add('endDate')
//            ->add('active')
//            ->add('OfferChoice', EntityType::class, [
//                'property_path' => 'Offer',
//                'class' => 'App\Entity\Offer',
//                'expanded' => false,
//                'multiple' => false
//            ])
//            ->add('guest')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\BloodBank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BloodBankSetupFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr'  =>  [
                    'class'         =>  'form-control',
                    'placeHolder'   =>  'Blood bank full name'
                ]
            ])
            ->add('address', TextType::class, [
                'attr'  =>  [
                    'class'         =>  'form-control',
                    'placeHolder'   =>  'Location (full address)'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BloodBank::class,
        ]);
    }
}

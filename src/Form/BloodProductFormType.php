<?php

namespace App\Form;

use App\Entity\BloodGroup;
use App\Entity\BloodProduct;
use App\Entity\BloodProductType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class BloodProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('createdAt')
            ->add('volume', IntegerType::class, [
                'attr'  =>  [
                    'class' =>  'form-control mb-1'
                ]
            ])
            ->add('price', MoneyType::class, [
                'currency'  =>  'USD',
                'attr'  =>  [
                    'class' =>  'form-control mb-1'
                ]
            ])
            // ->add('currency')
            ->add('bloodGroup', EntityType::class, [
                'class'         =>  BloodGroup::class,
                'choice_label'  =>  'code',
                'attr'  =>  [
                    'class' =>  'form-control mb-1 custom-select'
                ]
            ])
            ->add('type', EntityType::class, [
                'class'         =>  BloodProductType::class,
                'choice_label'  =>  'name',
                'attr'  =>  [
                    'class' =>  'form-control mb-1 custom-select'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BloodProduct::class,
        ]);
    }
}

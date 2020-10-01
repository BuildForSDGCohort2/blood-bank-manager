<?php

namespace App\Form;

use App\Entity\BloodProduct;
use App\Entity\BloodProductStock;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BloodProductStockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, [
                'class'     =>  BloodProduct::class,
                'choice_label'     =>  'name',
                'attr'  =>  [
                    'class' =>  'form-control mb-1 custom-select'
                ]
            ])
            ->add('expireAt')
            ->add('quantity', NumberType::class, [
                'attr'  =>  [
                    'class' =>  'form-control mb-1 custom-select'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BloodProductStock::class,
        ]);
    }
}

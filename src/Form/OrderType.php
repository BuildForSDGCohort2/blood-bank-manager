<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\OrderStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class OrderType extends AbstractType
{        
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('products', CollectionType::class, [
                'entry_type'    =>  BloodProductOrderType::class,
                'allow_add'     =>  true,
                'allow_delete'  =>  true,
            ])
            ->add('status', EntityType::class, [
                'class'         =>  OrderStatus::class,
                'choice_label'  =>  'designation',
                'attr'          =>  [
                    'class' =>  'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}

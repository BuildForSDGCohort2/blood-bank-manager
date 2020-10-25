<?php

namespace App\Form;

use App\Entity\BloodProduct;
use App\Entity\BloodProductOrder;
use App\Repository\BloodBankRepository;
use Symfony\Component\Form\AbstractType;
use App\Repository\BloodProductRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BloodProductOrderType extends AbstractType
{
    /** @var App\Entity\BloodBank $bloodBank */
    private $bloodBank;


    public function __construct(SessionInterface $session, BloodBankRepository $bloodBanks)
    {
        $this->bloodBank = $bloodBanks->findOneById(
            $session->get('bloodBank')->getId()
        );
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $bloodBank = $this->bloodBank;

        $builder
            ->add('product', EntityType::class, [
                'class'         =>  BloodProduct::class,
                'choice_label'  =>  'name',
                'attr'      =>  [
                    'class' =>  'form-control'
                ],
                'query_builder'  =>  function (BloodProductRepository $p) use ($bloodBank){
                    return $p->createQueryBuilder('p')
                        ->leftJoin('p.bloodBank', 'b')
                        ->addSelect('b')
                        ->andWhere('b.id = :id')
                        ->setParameter(':id', $bloodBank->getId());
                },
            ])
            ->add('quantity', NumberType::class, [
                'attr'      =>  [
                    'class' =>  'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BloodProductOrder::class,
        ]);
    }
}

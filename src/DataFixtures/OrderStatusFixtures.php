<?php

namespace App\DataFixtures;

use App\Entity\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $statusNames = array(
            'pending',
            'completed',
            'canceled',
        );

        foreach ($statusNames as $key => $statusName) {
            $orderStatus = (new OrderStatus)->setDesignation($statusName);

            $manager->persist($orderStatus);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['prodFixture'];
    }
}

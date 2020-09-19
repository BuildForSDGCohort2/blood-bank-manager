<?php

namespace App\DataFixtures;

use App\Entity\BloodGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class BloodGroupFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['prodFixture'];
    }
    
    public function load(ObjectManager $manager)
    {
        $codes = ['a+', 'a-', 'b+', 'b-', 'ab-', 'ab+', 'o-', 'o+'];

        foreach ($codes as $key => $code) {
            $bloodGroup = (new BloodGroup)->setCode($code);
            $manager->persist($bloodGroup);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\BloodProductType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class BloodProductsTypeFixtures extends Fixture implements FixtureGroupInterface
{

    private AsciiSlugger $slugger;

    public function __construct()
    {
        $this->slugger = new AsciiSlugger();
    }

    public function load(ObjectManager $manager)
    {
        $types = array(
            'red cells',
            'plasma',
            'platelets',
        );

        foreach ($types as $key => $type) {
            $bloodProductType = (new BloodProductType)->setName($type);

            $slug = $this->slugger->slug(
                $bloodProductType->getName()
            );

            $bloodProductType->setSlug($slug);

            $manager->persist($bloodProductType);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['prodFixture'];
    }
}

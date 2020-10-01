<?php

namespace App\DataFixtures;

use App\Entity\BloodBank;
use App\Entity\BloodBankManager;
use App\Entity\User;
use App\Utils\BloodBankRoles;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User;
        $password = $this->encoder->encodePassword($user, 'theAdmin');

        $user
            ->setEmail('mike@gmail.com')
            ->setPassword($password)
            ->setIsVerified(true)
            ;
        $manager->persist($user);

        $bloodBank = (new BloodBank)
                                ->setCodeName('123ef-ffdr')
                                ->setName('GHMK')
                            ;
        $manager->persist($bloodBank);

        $roles = BloodBankRoles::get(BloodBankRoles::ADMIN);
        $bloodBankManager = (new BloodBankManager)->setRoles($roles);
        $manager->persist($bloodBankManager);
        
        $user->addManagedBloodBank($bloodBankManager);
        $bloodBank->addManager($bloodBankManager);


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            BloodGroupFixtures::class,
            BloodProductsTypeFixtures::class,
        );
    }
}

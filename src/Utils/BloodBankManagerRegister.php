<?php
namespace App\Utils;

use App\Entity\User;
use App\Entity\BloodBank;
use App\Utils\BloodBankRoles;
use App\Entity\BloodBankManager;
use Doctrine\ORM\EntityManagerInterface;


class BloodBankManagerRegister
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @var User $user The user to put as blood bank administrator
     * @var BloodBank $bloodBank
     * @var string $role The manager role in the bloodBank
     */
    public function create(User $user, BloodBank $bloodBank, string $role = BloodBankRoles::MANAGER)
    {
        $manager = new BloodBankManager;
        // the first manager must be the administrator
        $roles = BloodBankRoles::get($role);
        $manager->setRoles($roles);
        $bloodBank->addManager($manager);
        $user->addManagedBloodBank($manager);

        $this->entityManager->persist($manager);
        $this->entityManager->flush();
    }
}

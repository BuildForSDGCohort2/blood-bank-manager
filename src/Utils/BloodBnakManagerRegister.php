<?php
namespace App\Utils;

use App\Entity\BloodBank;
use App\Entity\BloodBankManager;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;


class BloodBnakManagerRegister
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @var User $user The user to put as blood bank administrator
     * @var BloodBank $bloodBank
     */
    public function create(User $user, BloodBank $bloodBank)
    {
        $manager = new BloodBankManager;
        // the first manager is the administrator
        $bloodBank->addManager($manager);
        $user->addManagedBloodBank($manager);

        $this->entityManager->persist($manager);
        $this->entityManager->flush();
    }
}

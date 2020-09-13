<?php
namespace App\Utils;

use App\Entity\User;
use App\Entity\BloodBank;
use App\Repository\BloodBankRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

class BloodBankRegister
{
    private $entityManager;
    private $bloodBanks;

    public function __construct(EntityManagerInterface $entityManager, BloodBankRepository $bloodBanks)
    {
        $this->entityManager = $entityManager;
        $this->bloodBanks = $bloodBanks;
    }

    /**
     * @var string $bloodBankCodeName The unique blood bank code name
     * @return BloodBank
     * @throws InvalidArgumentException 
     */
    public function create(string $bloodBankCodeName): BloodBank
    {
        $bloodBank = $this->bloodBanks->findOneByCodeName($bloodBankCodeName);

        if (null === $bloodBank) {
            $bloodBank = (new BloodBank)->setCodeName($bloodBankCodeName);

            $this->entityManager->persist($bloodBank);

            $this->entityManager->flush();

            return $bloodBank;
        }

        throw new InvalidArgumentException("This code name is already used", 1);
    }
}

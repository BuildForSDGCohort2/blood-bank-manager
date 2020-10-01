<?php

namespace App\Controller;

use App\Entity\BloodBank;
use App\Utils\BloodBankRoles;
use App\Form\BloodBankSetupFormType;
use App\Repository\BloodBankRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\LogicException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/blood-banks/")
 */
class BloodBankController extends AbstractController
{
    private $entityManager;
    private $flashy;


    public function __construct(EntityManagerInterface $entityManager, FlashyNotifier $flashy)
    {
        $this->entityManager = $entityManager;
        $this->flashy = $flashy;
    }

    /**
     * @Route("{codeName}", name="blood_bank")
     */
    public function index($codeName = null, SessionInterface $session, BloodBankRepository $bloodBanks)
    {
        if (!null == $codeName) {
            $bloodBank = $bloodBanks->findOneByCodeName($codeName);

            if ($bloodBank instanceof BloodBank) {
                $session->set('bloodBank', $bloodBank);

                return $this->redirectToRoute('dashboard', [
                    'codeName'  =>  $bloodBank->getCodeName(),
                ]);
            }
        }

        return $this->render('blood_bank/index.html.twig', []);
    }

    /**
     * Setup bloodbank with name and address
     * 
     * @Route("{id}/setup", name="blood_bank_setup")
     * @Security("bloodBank.isGranted(user, 'ROLE_ADMIN')")
     */
    public function setup(Request $request, BloodBank $bloodBank, SessionInterface $session)
    {
        if ($bloodBank->isSetup()) {
            throw new LogicException("Blood bank already setup", 1);
        }

        $form = $this->createForm(BloodBankSetupFormType::class, $bloodBank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bloodBank->setIsSetup(true);

            $this->entityManager->flush();

            $this->flashy->success('Your Blood Bank is ready to use!');

            // TODO: remove code duplication
            $session->set('bloodBank', $bloodBank);
            
            return $this->redirectToRoute('dashboard', [
                'codeName'  =>  $bloodBank->getCodeName()
            ]);
        }

        return $this->render('blood_bank/setup.html.twig', [
            'bloodbank' =>  $bloodBank,
            'setupForm' =>  $form->createView(),
        ]);
    }
}

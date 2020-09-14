<?php

namespace App\Controller;

use App\Entity\BloodBank;
use App\Form\BloodBankSetupFormType;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/blood-bank")
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
     * @Route("/", name="blood_bank")
     */
    public function index()
    {
        return $this->render('blood_bank/index.html.twig', [
            
        ]);
    }

    /**
     * Setup bloodbank with name and address
     * 
     * @Route("/{id}/setup", name="blood_bank_setup")
     */
    public function setup(Request $request, BloodBank $bloodBank)
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

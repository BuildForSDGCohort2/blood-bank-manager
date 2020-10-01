<?php

namespace App\Controller;

use App\Entity\BloodBank;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/app/")
 * @Security("bloodBank.isGranted(user, 'ROLE_MANAGER')")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("{codeName}/dashboard", name="dashboard")
     */
    public function index(BloodBank $bloodBank)
    {
        return $this->render('dashboard/index.html.twig', [
            'bloodBank' =>  $bloodBank,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\BloodBank;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/b")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/{codeName}/dashboard", name="dashboard")
     */
    public function index(BloodBank $bloodBank)
    {
        return $this->render('dashboard/index.html.twig', [
            'bloodBank' =>  $bloodBank,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\BloodProductTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(BloodProductTypeRepository $bloodProductTypes)
    {
        $bloodProductTypes = $bloodProductTypes->findAll();

        return $this->render('home/index.html.twig', [
            'bloodProductTypes' =>  $bloodProductTypes,
        ]);
    }
}

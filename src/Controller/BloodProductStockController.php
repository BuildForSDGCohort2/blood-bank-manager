<?php

namespace App\Controller;

use App\Entity\BloodBank;
use App\Entity\BloodProductStock;
use App\Form\BloodProductStockType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BloodProductStockRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/app/{codeName}/blood-products/inventory/")
 * @Security("bloodBank.isGranted(user, 'ROLE_MANAGER')")
 */
class BloodProductStockController extends AbstractController
{
    private $seesion;


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("", name="blood_product_stock_index", methods={"GET"})
     */
    public function index(BloodProductStockRepository $bloodProductStockRepository, BloodBank $bloodBank): Response
    {
        return $this->render('blood_product_stock/index.html.twig', [
            'blood_product_stocks' => $bloodProductStockRepository->findByBloodBank($bloodBank),
        ]);
    }

    /**
     * @Route("new", name="blood_product_stock_new", methods={"GET","POST"})
     */
    public function new(Request$request, BloodBank $bloodBank): Response
    {
        $bloodProductStock = new BloodProductStock();
        $form = $this->createForm(BloodProductStockType::class, $bloodProductStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bloodBank->addStock($bloodProductStock);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bloodProductStock);
            $entityManager->flush();

            return $this->redirectToRoute('blood_product_stock_index', [
                'codeName'  =>  $this->session->get('bloodBank')->getCodeName(),
            ]);
        }

        return $this->render('blood_product_stock/new.html.twig', [
            'blood_product_stock' => $bloodProductStock,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}/edit", name="blood_product_stock_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BloodProductStock $bloodProductStock): Response
    {
        $form = $this->createForm(BloodProductStockType::class, $bloodProductStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blood_product_stock_index', [
                'codeName'  =>  $this->session->get('bloodBank')->getCodeName(),
            ]);
        }

        return $this->render('blood_product_stock/edit.html.twig', [
            'blood_product_stock' => $bloodProductStock,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}", name="blood_product_stock_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BloodProductStock $bloodProductStock): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bloodProductStock->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bloodProductStock);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blood_product_stock_index', [
            'codeName'  =>  $this->session->get('bloodBank')->getCodeName(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\BloodBank;
use App\Entity\BloodProduct;
use App\Form\BloodProductFormType;
use App\Repository\BloodProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/b/{codeName}/blood-products")
 */
class BloodProductController extends AbstractController
{
    private $session;


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/", name="blood_product_index", methods={"GET"})
     */
    public function index(BloodProductRepository $bloodProductRepository, BloodBank $bloodBank): Response
    {
        return $this->render('blood_product/index.html.twig', [
            'blood_products' => $bloodProductRepository->findByBloodBank($bloodBank),
        ]);
    }

    /**
     * @Route("/new", name="blood_product_new", methods={"GET","POST"})
     */
    public function new(Request $request, BloodBank $bloodBank): Response
    {
        $bloodProduct = new BloodProduct();
        $form = $this->createForm(BloodProductFormType::class, $bloodProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bloodBank->addProduct($bloodProduct);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bloodProduct);
            $entityManager->flush();

            return $this->redirectToRoute('blood_product_index', [
                'codeName'  =>  $this->session->get('bloodBank')->getCodeName(),
            ]);
        }

        return $this->render('blood_product/new.html.twig', [
            'blood_product' => $bloodProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="blood_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BloodProduct $bloodProduct): Response
    {
        $form = $this->createForm(BloodProductFormType::class, $bloodProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blood_product_index', [
                'codeName'  =>  $this->session->get('bloodBank')->getCodeName(),
            ]);
        }

        return $this->render('blood_product/edit.html.twig', [
            'blood_product' => $bloodProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blood_product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BloodProduct $bloodProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bloodProduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bloodProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blood_product_index', [
            'codeName'  =>  $this->session->get('bloodBank')->getCodeName(),
        ]);
    }
}

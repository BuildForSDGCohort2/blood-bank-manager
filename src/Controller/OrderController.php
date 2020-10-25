<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Entity\BloodBank;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/app/{codeName}/orders/")
 * 
 * Add this because without ParamConverter don't work
 * @ParamConverter("bloodBank", options={"mapping": {"codeName": "codeName"}})
 * 
 * @Security("bloodBank.isGranted(user, 'ROLE_MANAGER')")
 */
class OrderController extends AbstractController
{
    /**
     * @Route("", name="order_index", methods={"GET"})
     */
    public function index(OrderRepository $orderRepository, BloodBank $bloodBank): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findByBloodBank($bloodBank),
        ]);
    }

    /**
     * @Route("new", name="order_new", methods={"GET","POST"})
     */
    public function new(Request $request, BloodBank $bloodBank): Response
    {
        $order = new Order();
        $order->setBloodBank($bloodBank);

        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid() && !$order->getProducts()->isEmpty()) {
            /** @var \App\Entity\BloodProductOrder $product  */
            foreach ($order->getProducts() as $key => $product) {
                $product->setOrder($order);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();
            dump($order);
            return $this->redirectToRoute('order_index', [
                'codeName'  =>  $bloodBank->getCodeName()
            ]);
        }

        return $this->render('order/new.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}", name="order_show", methods={"GET"})
     * @var BloodBank $bloodBank Add this because without this ParamConverter don't work
     */
    public function show(BloodBank $bloodBank, Order $order): Response
    {
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("{id}/edit", name="order_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Order $order, BloodBank $bloodBank): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_index', [
                'codeName'  =>  $bloodBank->getCodeName()
            ]);
        }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}", name="order_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Order $order, BloodBank $bloodBank): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_index', [
            'codeName'  =>  $bloodBank->getCodeName()
        ]);
    }
}

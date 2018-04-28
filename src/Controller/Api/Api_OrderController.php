<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/23/2018
 * Time: 10:36 AM
 */

namespace App\Controller\Api;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\ResponseGenerator;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class Api_OrderController extends Controller
{
    /**
     * @Route("/api/orders", name="get orders")
     * @Method({"GET"})
     */
    public function getOrdersAction(ResponseGenerator $responseGenerator)
    {
        $orders = $this->getDoctrine()
            ->getRepository(Order::class)
            ->getOrders();

        return $responseGenerator->createResponse($orders);
    }

    /**
     * @Route("/api/order/{id}", name="get order")
     * @Method({"GET"})
     */
    public function getOrderAction($id, ResponseGenerator $responseGenerator)
    {
        $order = $this->getDoctrine()
            ->getRepository(Order::class)
            ->getOrder($id);

        return $responseGenerator->createResponse($order);
    }

    /**
     * @Route("/api/order/add", name="add order")
     * @Method({"POST"})
     */
    public function addAction(Request $request)
    {
        $this->getDoctrine()
            ->getRepository(Order::class)
            ->addOrder($request->getContent());

        return $this->json('Order successfully added', 200);
    }

    /**
     * @Route("/api/order/delete/{id}", name="delete order")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        $this->getDoctrine()
            ->getRepository(Order::class)
            ->deleteOrder($id);

        return $this->json('Order successfully deleted', 200);
    }

    /**
     * @Route("/api/order/update", name="update order")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request)
    {
        $this->getDoctrine()
            ->getRepository(Order::class)
            ->updateOrder($request->getContent());

        return $this->json('Order successfully updated', 200);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/4/2018
 * Time: 8:03 PM
 */

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Course;
use App\Entity\Order;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class OrdersController extends Controller
{
    private $limit;
    private $order;

    public function __construct()
    {
        $this->order = ['date' => 'desc'];
        $this->limit = 10;
    }

    /**
     * @Route("/admin/orders/{page}", name="admin orders")
     * @Method({"GET"})
     */
    public function indexAction($page)
    {
        $criteria = [];
        $queryString = null;

        $orders = $this->getDoctrine()->getRepository(Order::class)->findBy($criteria, $this->order, $this->limit, ($page-1)*$this->limit);
        $pagesCount = $this->getDoctrine()->getRepository(Order::class)->count($criteria, $this->order, $this->limit, ($page-1)*$this->limit) / $this->limit;

        return $this->render('private/orders/index.html.twig', [
            'orders' => $orders,
            'pagesCount' => $pagesCount,
            'queryString' => $queryString,
            'page' => $page
        ]);
    }
}
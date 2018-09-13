<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/4/2018
 * Time: 7:42 PM
 */

namespace App\Controller\Admin;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    private $limit;
    private $order;

    public function __construct()
    {
        $this->order = ['date' => 'desc'];
        $this->limit = 20;
    }

    /**
     * @Route("/admin/products/{page}", name="admin products")
     * @Method({"GET"})
     */
    public function indexAction($page)
    {
        $criteria = [];
        $queryString = null;

        $products = $this->getDoctrine()->getRepository(Product::class)->findBy($criteria, $this->order, $this->limit, ($page-1)*$this->limit);
        $total = $this->getDoctrine()->getRepository(Product::class)->count($criteria, $this->order, $this->limit, ($page-1)*$this->limit);
        $pagesCount =  ceil($total/ $this->limit);

        return $this->render('private/products/index.html.twig', [
            'products' => $products,
            'pagesCount' => $pagesCount,
            'queryString' => $queryString,
            'page' => $page,
            'total' => $total
        ]);
    }
}
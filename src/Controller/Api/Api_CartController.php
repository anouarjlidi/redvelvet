<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 3/4/2018
 * Time: 11:18 AM
 */

namespace App\Controller\Api;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Service\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ResponseGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class Api_CartController extends Controller
{
    /**
     * @Route("/api/cart/add", name="add product to cart")
     * @Method({"POST"})
     */
    public function addAction(Request $request, Cart $cart)
    {
        $cart->addProductToCart($request->request->get('productId'));
        return $this->json('Product successfully added to cart', 200);
    }

    /**
     * @Route("/api/cart/delete", name="delete product from cart")
     * @Method({"POST"})
     */
    public function deleteAction(Request $request, Cart $cart)
    {
        $cart->deleteProductFromCart($request->request->get('productId'));
        return $this->json('Product successfully deleted from cart', 200);
    }

    /**
     * @Route("/api/cart", name="get cart products")
     * @Method({"GET"})
     */
    public function indexAction(Request $request, Cart $cart)
    {
        $productsRepository = $this->getDoctrine()->getRepository(Product::class);
        $products = $cart->getProducts($productsRepository);
        return $this->json($products, 200);
    }


}
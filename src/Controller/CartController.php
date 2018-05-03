<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 3/4/2018
 * Time: 11:54 AM
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\Cart;
use App\Type\ShippingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart")
     * @Method({"GET"})
     */
    public function indexAction(Cart $cart)
    {
        return $this->render('public/cart/index.html.twig', array(
            'products' => $cart->get(),
            'navCategories' => $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null])
        ));
    }

}
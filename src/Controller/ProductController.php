<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/27/2018
 * Time: 1:38 PM
 */

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProductController extends Controller
{

    /**
     * @Route("/product/{id}", name="product")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        return $this->render('public/product/index.html.twig', array(
            'product' => $product
        ));
    }

}
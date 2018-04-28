<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/18/2018
 * Time: 4:18 PM
 */

namespace App\Controller\Api;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\ResponseGenerator;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class Api_ProductController extends Controller
{
    /**
     * @Route("/api/products", name="get products")
     * @Method({"GET"})
     */
    public function getProductsAction(ResponseGenerator $responseGenerator)
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->getProducts();

        return $responseGenerator->createResponse($products);
    }

    /**
     * @Route("/api/product/{id}", name="get product")
     * @Method({"GET"})
     */
    public function getProductAction($id, ResponseGenerator $responseGenerator)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->getProduct($id);

        return $responseGenerator->createResponse($product);
    }

    /**
     * @Route("/api/product/add", name="add product")
     * @Method({"POST", "OPTIONS"})
     */
    public function addAction(Request $request)
    {
        $this->getDoctrine()
            ->getRepository(Product::class)
            ->addProduct($request->getContent());

        return $this->json('Product successfully added', 200);
    }

    /**
     * @Route("/api/product/delete/{id}", name="delete product")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        $this->getDoctrine()
            ->getRepository(Product::class)
            ->deleteProduct($id);

        return $this->json('Product successfully deleted', 200);
    }

    /**
     * @Route("/api/product/update", name="update product")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request)
    {
        $this->getDoctrine()
            ->getRepository(Product::class)
            ->updateProduct($request->getContent());

        return $this->json('Product successfully updated', 200);
    }


}
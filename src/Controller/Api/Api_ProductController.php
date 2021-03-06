<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/1/2018
 * Time: 9:29 PM
 */

namespace App\Controller\Api;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class Api_ProductController extends Controller
{
    /**
     * @Route("/api/product", name="get product")
     * @Method({"POST"})
     */
    public function indexAction(Request $request)
    {
        $productId = $request->request->get('productId');

        $product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

        if(!$product)
        {
            $this->addFlash('error', 'Produktas nerastas');
            $this->redirectToRoute('home');
        }

        $data['id'] = $product->getId();
        $data['title'] = $product->getTitle();
        $data['price'] = $product->getPrice();
        $data['units'] = $product->getUnits();

        return $this->json($data);
    }

}
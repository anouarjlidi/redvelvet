<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/27/2018
 * Time: 1:38 PM
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\ProductType;
use App\Service\FileService;
use App\Service\PathFinder;
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
    public function indexAction($id, PathFinder $pathFinder)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if(!$product)
        {
            $this->addFlash('error', 'Produktas nerastas');
            return $this->redirectToRoute('home');
        }

        $path = $pathFinder->getFullPath($product->getCategory()->getId());

        return $this->render('public/product/index.html.twig', array(
            'product' => $product,
            'path' => $path
        ));
    }

}
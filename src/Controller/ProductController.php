<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/27/2018
 * Time: 1:38 PM
 */

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\FileUploader;
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

        $path = $pathFinder->getFullPath($product->getCategory()->getId());

        return $this->render('public/product/index.html.twig', array(
            'product' => $product,
            'path' => $path
        ));
    }

    /**
     * @Route("/admin/product/add", name="add product")
     */
    public function addAction(Request $request, FileUploader $fileUploader)
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filename = $fileUploader->upload($product->getPhoto());
            $product->setPhoto($filename);
            $this->getDoctrine()->getRepository(Product::class)->add($product);

        }

        return $this->render('private/product/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/4/2018
 * Time: 9:29 PM
 */

namespace App\Controller\Admin;

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
     * @Route("/admin/product/add", name="admin add product")
     */
    public function addAction(Request $request, FileService $fileService)
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product, ['validation_groups' => array('add')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filename = $fileService->upload($product->getPhoto());
            $product->setPhoto($filename);
            $this->getDoctrine()->getRepository(Product::class)->add($product);
            return $this->redirectToRoute('admin products', ['page' => 1]);
        }

        return $this->render('private/product/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/product/edit/{id}", name="admin edit product")
     */
    public function editAction(Request $request, FileService $fileService, $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if(!$product)
        {
            return $this->redirectToRoute('admin products', ['page' => 1]);
        }

        $photo = $product->getPhoto();

        $form = $this->createForm(ProductType::class, $product, ['validation_groups' => array('edit')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            if($product->getPhoto())
            {
                $fileService->delete($photo);
                $filename = $fileService->upload($product->getPhoto());
                $product->setPhoto($filename);
            }
            else
            {
                $product->setPhoto($photo);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin product', ['id' => $id]);
        }

        return $this->render('private/product/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/product/view/{id}", name="admin product")
     */
    public function indexAction($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if(!$product)
        {
            return $this->redirectToRoute('admin products', ['page' => 1]);
        }

        return $this->render('private/product/index.html.twig', array(
            'product' => $product
        ));
    }
}
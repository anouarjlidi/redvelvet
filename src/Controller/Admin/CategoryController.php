<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/4/2018
 * Time: 9:50 PM
 */

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\CategoryType;
use App\Form\ProductType;
use App\Service\FileService;
use App\Service\PathFinder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CategoryController extends Controller
{
    /**
     * @Route("/admin/category/add", name="add category")
     */
    public function addAction(Request $request, FileService $fileService)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category, ['validation_groups' => array('add')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filename = $fileService->upload($category->getPhoto());
            $category->setPhoto($filename);
            $this->getDoctrine()->getRepository(Category::class)->add($category);
            return $this->redirectToRoute('admin categories', ['page' => 1]);
        }

        return $this->render('private/category/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/category/edit/{id}", name="admin edit category")
     */
    public function editAction(Request $request, FileService $fileService, $id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        if(!$category)
        {
            return $this->redirectToRoute('admin categories', ['page' => 1]);
        }

        $photo = $category->getPhoto();

        $form = $this->createForm(CategoryType::class, $category, ['validation_groups' => array('edit')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            if($category->getPhoto())
            {
                $fileService->delete($photo);
                $filename = $fileService->upload($category->getPhoto());
                $category->setPhoto($filename);
            }
            else
            {
                $category->setPhoto($photo);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin category', ['id' => $id]);
        }

        return $this->render('private/category/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/category/view/{id}", name="admin category")
     */
    public function indexAction($id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        if(!$category)
        {
            return $this->redirectToRoute('admin categories', ['page' => 1]);
        }

        return $this->render('private/category/index.html.twig', array(
            'category' => $category
        ));
    }
}
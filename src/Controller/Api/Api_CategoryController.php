<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/18/2018
 * Time: 4:23 PM
 */

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Service\ResponseGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class Api_CategoryController extends Controller
{
    /**
     * @Route("/api/categories", name="get categories")
     * @Method({"GET"})
     */
    public function getCategoriesAction(ResponseGenerator $responseGenerator)
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->getCategories();

        return $responseGenerator->createResponse($categories);
    }

    /**
     * @Route("/api/category/{id}", name="get category")
     * @Method({"GET"})
     */
    public function getCategoryAction($id, ResponseGenerator $responseGenerator)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->getCategory($id);

        return $responseGenerator->createResponse($category);
    }

    /**
     * @Route("/api/category/add", name="add category")
     * @Method({"POST"})
     */
    public function addAction(Request $request)
    {
        $this->getDoctrine()
            ->getRepository(Category::class)
            ->addCategory($request->getContent());

        return $this->json('Category successfully added', 200);
    }

    /**
     * @Route("/api/category/delete/{id}", name="delete category")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        $this->getDoctrine()
            ->getRepository(Category::class)
            ->deleteCategory($id);

        return $this->json('Category successfully deleted', 200);
    }

    /**
     * @Route("/api/category/update", name="update category")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request)
    {
        $this->getDoctrine()
            ->getRepository(Category::class)
            ->updateCategory($request->getContent());

        return $this->json('Category successfully updated', 200);
    }
}
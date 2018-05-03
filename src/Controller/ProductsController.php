<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/28/2018
 * Time: 2:01 PM
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Service\PathFinder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProductsController extends Controller
{

    private $limit;

    public function __construct()
    {
        $this->limit = 8;
    }

    /**
     * @Route("/products/{category}/{page}", name="products")
     * @Method({"GET"})
     */
    public function indexAction($page, $category, PathFinder $pathFinder)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($category);

        if(!$category)
        {
            $this->addFlash('error', 'Kategorija nerasta');
            $this->redirectToRoute('home');
        }

        $path = $pathFinder->getFullPath($category);
        $products = $this->getDoctrine()->getRepository(Product::class)->findBy(['category' => $category], [], $this->limit, ($page-1)*$this->limit);
        $pagesCount = ceil($this->getDoctrine()->getRepository(Product::class)->count(['category' => $category])/$this->limit);

        return $this->render('public/products/index.html.twig', array(
            'products' => $products,
            'category' => $category,
            'page' => $page,
            'path' => $path,
            'pagesCount' => $pagesCount,
            'navCategories' => $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null])
        ));
    }

}
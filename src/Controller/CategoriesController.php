<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/29/2018
 * Time: 11:37 AM
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Gallery;
use App\Entity\Product;
use App\Service\PathFinder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CategoriesController extends Controller
{
    private $limit;

    public function __construct()
    {
        $this->limit = 8;
    }

    /**
     * @Route("/categories/{parent}", name="categories")
     * @Method({"GET"})
     */
    public function indexAction($parent = null, PathFinder $pathFinder)
    {
        if($parent)
        {
            $parent = $this->getDoctrine()->getRepository(Category::class)->find($parent);

            if(!$parent)
            {
                $this->addFlash('error', 'Kategorija nerasta');
                $this->redirectToRoute('home');
            }

            $data['path'] = $pathFinder->getFullPath($parent);
            $data['parent'] = $parent;
            $data['categories'] = $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => $parent]);
        }
        else
        {
            $data['categories'] = $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null]);
        }

        $data['navCategories'] = $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null]);

        return $this->render('public/categories/index.html.twig', $data);
    }
}
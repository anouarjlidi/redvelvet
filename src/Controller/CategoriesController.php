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
     * @Route("/categories/{parent}", name="subcategories")
     * @Method({"GET"})
     */
    public function indexAction($parent, PathFinder $pathFinder)
    {
        if($parent == 0)
        {
            $data['categories'] = $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null]);
            $data['parent'] = null;
        }
        else
        {
            $parent = $this->getDoctrine()->getRepository(Category::class)->find($parent);

            if(!$parent)
            {
                $this->addFlash('error', 'Kategorija nerasta');
                return $this->redirectToRoute('home');
            }

            $data['parent'] = $parent;
            $data['path'] = $pathFinder->getFullPath($parent);
            $data['categories'] = $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => $parent]);
        }

        $data['navCategories'] = $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null]);

        return $this->render('public/categories/index.html.twig', $data);
    }
}
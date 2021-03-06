<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/4/2018
 * Time: 8:03 PM
 */

namespace App\Controller\Admin;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CategoriesController extends Controller
{
    private $limit;
    private $order;

    public function __construct()
    {
        $this->order = ['date' => 'desc'];
        $this->limit = 20;
    }

    /**
     * @Route("/admin/categories/{page}", name="admin categories")
     * @Method({"GET"})
     */
    public function indexAction($page)
    {
        $criteria = [];
        $queryString = null;

        $categories = $this->getDoctrine()->getRepository(Category::class)->findBy($criteria, $this->order, $this->limit, ($page-1)*$this->limit);
        $total = $this->getDoctrine()->getRepository(Category::class)->count($criteria, $this->order, $this->limit, ($page-1)*$this->limit);
        $pagesCount =  ceil($total/ $this->limit);

        return $this->render('private/categories/index.html.twig', [
            'categories' => $categories,
            'pagesCount' => $pagesCount,
            'queryString' => $queryString,
            'page' => $page,
            'total' => $total
        ]);
    }
}
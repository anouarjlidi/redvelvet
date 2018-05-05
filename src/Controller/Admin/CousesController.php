<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/4/2018
 * Time: 8:21 PM
 */

namespace App\Controller\Admin;

use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CousesController extends Controller
{
    private $limit;
    private $order;

    public function __construct()
    {
        $this->order = ['date' => 'desc'];
        $this->limit = 10;
    }

    /**
     * @Route("/admin/courses/{page}", name="admin courses")
     * @Method({"GET"})
     */
    public function indexAction($page)
    {
        $criteria = [];
        $queryString = null;

        $courses = $this->getDoctrine()->getRepository(Course::class)->findBy($criteria, $this->order, $this->limit, ($page-1)*$this->limit);
        $pagesCount = $this->getDoctrine()->getRepository(Course::class)->count($criteria, $this->order, $this->limit, ($page-1)*$this->limit) / $this->limit;

        return $this->render('private/courses/index.html.twig', [
            'courses' => $courses,
            'pagesCount' => $pagesCount,
            'queryString' => $queryString,
            'page' => $page
        ]);
    }
}
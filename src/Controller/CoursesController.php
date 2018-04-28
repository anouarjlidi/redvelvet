<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/28/2018
 * Time: 3:54 PM
 */

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CoursesController extends Controller
{
    private $limit;

    public function __construct()
    {
        $this->limit = 8;
    }

    /**
     * @Route("/courses/{page}", name="courses")
     * @Method({"GET"})
     */
    public function indexAction($page)
    {
        $courses = $this->getDoctrine()->getRepository(Course::class)->findBy([], [], $this->limit, ($page-1)*$this->limit);
        $pagesCount = ceil($this->getDoctrine()->getRepository(Course::class)->count([])/$this->limit);

        return $this->render('public/courses/index.html.twig', array(
            'courses' => $courses,
            'pagesCount' => $pagesCount,
            'page' => $page
        ));
    }
}

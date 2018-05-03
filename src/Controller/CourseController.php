<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/28/2018
 * Time: 5:46 PM
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Course;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CourseController extends Controller
{
    /**
     * @Route("/course/{id}", name="course")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);

        if(!$course)
        {
            $this->addFlash('error', 'Kursai nerasti');
            $this->redirectToRoute('home');
        }


        return $this->render('public/course/index.html.twig', array(
            'course' => $course,
            'navCategories' => $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null])
        ));
    }
}
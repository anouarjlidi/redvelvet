<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/4/2018
 * Time: 9:56 PM
 */

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Course;
use App\Entity\Product;
use App\Form\CategoryType;
use App\Form\CourseType;
use App\Form\ProductType;
use App\Service\FileService;
use App\Service\PathFinder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CourseController extends Controller
{
    /**
     * @Route("/admin/course/add", name="admin add course")
     */
    public function addAction(Request $request, FileService $fileService)
    {
        $course = new Course();

        $form = $this->createForm(CourseType::class, $course, ['validation_groups' => array('add')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filename = $fileService->upload($course->getPhoto());
            $course->setPhoto($filename);
            $this->getDoctrine()->getRepository(Course::class)->add($course);
            return $this->redirectToRoute('admin courses', ['page' => 1]);
        }

        return $this->render('private/course/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/course/edit/{id}", name="admin edit course")
     */
    public function editAction(Request $request, FileService $fileService, $id)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);

        if(!$course)
        {
            return $this->redirectToRoute('admin courses', ['page' => 1]);
        }

        $photo = $course->getPhoto();

        $form = $this->createForm(CourseType::class, $course, ['validation_groups' => array('edit')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            if($course->getPhoto())
            {
                $fileService->delete($photo);
                $filename = $fileService->upload($course->getPhoto());
                $course->setPhoto($filename);
            }
            else
            {
                $course->setPhoto($photo);
            }


            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin course', ['id' => $id]);
        }

        return $this->render('private/course/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/course/view/{id}", name="admin course")
     */
    public function indexAction($id)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);

        if(!$course)
        {
            return $this->redirectToRoute('admin courses', ['page' => 1]);
        }

        return $this->render('private/course/index.html.twig', array(
            'course' => $course
        ));
    }
}
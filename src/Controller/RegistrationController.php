<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/28/2018
 * Time: 6:36 PM
 */


namespace App\Controller;

use App\Entity\Category;
use App\Entity\Course;
use App\Entity\Product;
use App\Entity\Registration;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RegistrationController extends Controller
{
    /**
     * @Route("/course/{id}/registration", name="registration")
     */
    public function addAction($id, Request $request)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);

        if(!$course)
        {
            $this->addFlash('error', 'Kursai nerasti');
            $this->redirectToRoute('home');
        }

        $registration = new Registration();

        $form = $this->createForm(RegistrationType::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $registration->setCourse($course);
            $this->getDoctrine()->getRepository(Registration::class)->add($registration);
        }

        return $this->render('public/registration/index.html.twig', array(
            'course' => $course,
            'form' => $form->createView(),
            'navCategories' => $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null])
        ));
    }
}


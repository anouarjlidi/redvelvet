<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/5/2018
 * Time: 12:57 PM
 */

namespace App\Controller\Admin\Api;

use App\Entity\Category;
use App\Entity\Course;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Service\Cart;
use App\Service\FileService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ResponseGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class Api_CourseController extends Controller
{
    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/api/course/delete", name="admin delete course")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, FileService $fileService)
    {
        $id = $request->request->get('id');

        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);

        if(!$course)
        {
            $this->addFlash('error', 'Kursai nerasti');
            $this->redirectToRoute('admin dashboard');
        }

        $fileService->delete($course->getPhoto());

        $this->getDoctrine()->getManager()->remove($course);
        $this->getDoctrine()->getManager()->flush();

        return $this->json("Kursai sėkmingai ištrinti");
    }

}
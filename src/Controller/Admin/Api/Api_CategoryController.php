<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/5/2018
 * Time: 12:56 PM
 */

namespace App\Controller\Admin\Api;

use App\Entity\Category;
use App\Service\FileService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class Api_CategoryController extends Controller
{

    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/api/category/delete", name="admin delete category")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, FileService $fileService)
    {
        $id = $request->request->get('id');

        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        if(!$category)
        {
            $this->addFlash('error', 'Kategorija nerasta');
            $this->redirectToRoute('admin dashboard');
        }

        $fileService->delete($category->getPhoto());

        $this->getDoctrine()->getManager()->remove($category);
        $this->getDoctrine()->getManager()->flush();

        return $this->json("Kategorija sėkmingai ištrinta");
    }

}
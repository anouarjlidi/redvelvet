<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/5/2018
 * Time: 12:58 PM
 */

namespace App\Controller\Admin\Api;

use App\Entity\Gallery;
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


class Api_GalleryController extends Controller
{
    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/api/gallery/delete", name="admin delete gallery")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, FileService $fileService)
    {
        $id = $request->request->get('id');

        $gallery = $this->getDoctrine()->getRepository(Gallery::class)->find($id);

        if(!$gallery)
        {
            $this->addFlash('error', 'Galerija nerastas');
            $this->redirectToRoute('admin dashboard');
        }

        $fileService->delete($gallery->getPhoto());

        $this->getDoctrine()->getManager()->remove($gallery);
        $this->getDoctrine()->getManager()->flush();

        return $this->json("Galerija sėkmingai ištrinta");
    }

}
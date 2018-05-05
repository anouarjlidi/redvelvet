<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/5/2018
 * Time: 12:53 PM
 */

namespace App\Controller\Admin\Api;

use App\Entity\Product;
use App\Service\FileService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class Api_ProductController extends Controller
{
    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/api/product/delete", name="admin delete product")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, FileService $fileService)
    {
        $id = $request->request->get('id');

        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if(!$product)
        {
            $this->addFlash('error', 'Produktas nerastas');
            $this->redirectToRoute('admin dashboard');
        }

        $fileService->delete($product->getPhoto());

        $this->getDoctrine()->getManager()->remove($product);
        $this->getDoctrine()->getManager()->flush();

        return $this->json("Produktas sėkmingai ištrintas");
    }

}
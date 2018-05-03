<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/30/2018
 * Time: 9:56 PM
 */

namespace App\Controller;

use App\Entity\Gallery;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GalleryController extends Controller
{
    /**
     * @Route("/gallery/{id}", name="gallery")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {
        $gallery = $this->getDoctrine()->getRepository(Gallery::class)->find($id);

        if(!$gallery)
        {
            $this->addFlash('error', 'Galerija nerasta');
            $this->redirectToRoute('home');
        }

        return $this->render('public/gallery/index.html.twig', array(
            'gallery' => $gallery
        ));
    }
}
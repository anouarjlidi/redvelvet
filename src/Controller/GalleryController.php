<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/30/2018
 * Time: 9:56 PM
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Gallery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
            return $this->redirectToRoute('home');
        }

        return $this->render('public/gallery/index.html.twig', array(
            'gallery' => $gallery,
            'navCategories' => $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null])
        ));
    }
}
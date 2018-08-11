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
use App\Entity\Photo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GalleryController extends Controller
{
    /**
     * @Route("/gallery", name="gallery")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $photos = $this->getDoctrine()->getRepository(Photo::class)->findAll();

        return $this->render('public/gallery/index.html.twig', array(
            'photos' => $photos,
            'navCategories' => $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null])
        ));
    }
}
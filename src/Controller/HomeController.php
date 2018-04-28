<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/25/2018
 * Time: 9:25 PM
 */

namespace App\Controller;

use App\Entity\Feedback;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class HomeController extends Controller{

    /**
     * @Route("/", name="home")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findBy([], [], 4, 0);

        $feedbacks = $this->getDoctrine()->getRepository(Feedback::class)->findBy([], [], 3, 0);

        return $this->render('public/home/index.html.twig', array(
            'products' => $products,
            'feedbacks' => $feedbacks
        ));
    }


}
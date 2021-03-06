<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/4/2018
 * Time: 7:12 PM
 */

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DashboardController extends Controller
{
    /**
     * @Route("/admin/dashboard", name="admin dashboard")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return $this->render('private/dashboard/index.html.twig');
    }
}
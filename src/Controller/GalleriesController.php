<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/28/2018
 * Time: 7:05 PM
 */

namespace App\Controller;

    use App\Entity\Category;
    use App\Entity\Gallery;
    use App\Entity\Product;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GalleriesController extends Controller
{
    private $limit;

    public function __construct()
    {
        $this->limit = 8;
    }

    /**
     * @Route("/galleries/{page}", name="galleries")
     * @Method({"GET"})
     */
    public function indexAction($page)
    {
        $galleries = $this->getDoctrine()->getRepository(Gallery::class)->findBy([], [], $this->limit, ($page-1)*$this->limit);
        $pagesCount = ceil($this->getDoctrine()->getRepository(Gallery::class)->count([])/$this->limit);

        return $this->render('public/galleries/index.html.twig', array(
            'galleries' => $galleries,
            'page' => $page,
            'pagesCount' => $pagesCount,
            'navCategories' => $this->getDoctrine()->getRepository(Category::class)->findBy(['parent' => null])
        ));
    }
}
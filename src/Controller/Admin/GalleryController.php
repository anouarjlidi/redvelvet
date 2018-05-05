<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/5/2018
 * Time: 10:09 AM
 */

namespace App\Controller\Admin;

use App\Entity\Gallery;
use App\Form\GalleryType;
use App\Service\FileService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GalleryController extends Controller
{
    /**
     * @Route("/admin/gallery/add", name="admin add gallery")
     */
    public function addAction(Request $request, FileService $fileService)
    {
        $gallery = new Gallery();

        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filename = $fileService->upload($gallery->getPhoto());
            $gallery->setPhoto($filename);
            $this->getDoctrine()->getRepository(Gallery::class)->add($gallery);
            return $this->redirectToRoute('admin galleries', ['page' => 1]);
        }

        return $this->render('private/gallery/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/gallery/edit/{id}", name="admin edit gallery")
     */
    public function editAction(Request $request, FileService $fileService, $id)
    {
        $gallery = $this->getDoctrine()->getRepository(Gallery::class)->find($id);
        $photo = $gallery->getPhoto();

        if(!$gallery)
        {
            return $this->redirectToRoute('admin galleries', ['page' => 1]);
        }

        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            if($gallery->getPhoto())
            {
                $fileService->delete($photo);
                $filename = $fileService->upload($gallery->getPhoto());
                $gallery->setPhoto($filename);
            }
            else
            {
                $gallery->setPhoto($photo);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin gallery', ['id' => $id]);
        }

        return $this->render('private/gallery/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/gallery/view/{id}", name="admin gallery")
     */
    public function indexAction($id)
    {
        $gallery = $this->getDoctrine()->getRepository(Gallery::class)->find($id);

        if(!$gallery)
        {
            return $this->redirectToRoute('admin galleries', ['page' => 1]);
        }

        return $this->render('private/gallery/index.html.twig', array(
            'gallery' => $gallery
        ));
    }
}
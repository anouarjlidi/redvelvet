<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/28/2018
 * Time: 7:11 PM
 */


namespace App\Repository;

use App\Entity\Gallery;
use Doctrine\ORM\EntityRepository;

class GalleryRepository extends EntityRepository
{
    public function add(Gallery $gallery)
    {
        $this->getEntityManager()->persist($gallery);
        $this->getEntityManager()->flush();
        return $gallery->getId();
    }


}
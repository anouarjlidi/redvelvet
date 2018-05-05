<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 5/5/2018
 * Time: 10:27 AM
 */

namespace App\Repository;

use App\Entity\Photo;
use App\Entity\Product;
use Doctrine\ORM\EntityRepository;

class PhotoRepository extends EntityRepository
{
    public function add(Photo $photo)
    {
        $this->getEntityManager()->persist($photo);
        $this->getEntityManager()->flush();
        return $photo->getId();
    }

}
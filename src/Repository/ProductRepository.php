<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/19/2018
 * Time: 9:24 PM
 */

namespace App\Repository;

use App\Entity\Product;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{

    public function add(Product $product)
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
        return $product->getId();
    }

    public function delete(Product $product)
    {
        $this->getEntityManager()->remove($product);
        $this->getEntityManager()->flush();
    }

}
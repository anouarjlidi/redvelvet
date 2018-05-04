<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/29/2018
 * Time: 11:18 AM
 */

namespace App\Repository;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function add(Category $category)
    {
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();
        return $category->getId();
    }
}
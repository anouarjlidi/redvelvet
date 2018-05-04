<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/28/2018
 * Time: 4:02 PM
 */

namespace App\Repository;

use App\Entity\Course;
use Doctrine\ORM\EntityRepository;

class CourseRepository extends EntityRepository
{
    public function add(Course $course)
    {
        $this->getEntityManager()->persist($course);
        $this->getEntityManager()->flush();
        return $course->getId();
    }
}
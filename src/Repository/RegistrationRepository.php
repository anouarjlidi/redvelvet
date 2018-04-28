<?php
/**
 * Created by PhpStorm.
 * User: Vytautas
 * Date: 4/28/2018
 * Time: 6:28 PM
 */

namespace App\Repository;

use App\Entity\Registration;
use Doctrine\ORM\EntityRepository;

class RegistrationRepository extends EntityRepository
{

    public function add(Registration $registration)
    {
        $this->getEntityManager()->persist($registration);
        $this->getEntityManager()->flush();
        return $registration->getId();
    }

    public function delete(Registration $registration)
    {
        $this->getEntityManager()->remove($registration);
        $this->getEntityManager()->flush();
    }

}
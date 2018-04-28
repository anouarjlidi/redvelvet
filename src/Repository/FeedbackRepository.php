<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/28/2018
 * Time: 10:31 PM
 */

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\Entity\Feedback;
use Doctrine\ORM\Mapping;
use App\Service\JsonConverter;

class FeedbackRepository extends EntityRepository
{
    private $jsonConverter;

    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->jsonConverter = new JsonConverter();
    }

    public function getFeedbacks()
    {
        $feedbacks = $this->findAll();
        return $feedbacks;
        // return $this->jsonConverter->objectToJson($feedback);
    }

}
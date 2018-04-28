<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/19/2018
 * Time: 10:21 PM
 */

namespace App\Service;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class JsonConverter
{
    private $serializer;

    public function __construct()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function objectToJson($object)
    {
        return $this->serializer->serialize($object, 'json');
    }

    public function jsonToObject($json, $classType)
    {
        return $this->serializer->deserialize($json, $classType, 'json');
    }
}
<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/19/2018
 * Time: 10:16 PM
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class ResponseGenerator
{
    public function createResponse($data)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent($data);
        return $response;
    }
}
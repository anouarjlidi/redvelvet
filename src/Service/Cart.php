<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 3/4/2018
 * Time: 12:12 PM
 */

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class Cart
{
    private $session;
    private $products;
    private $productRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->productRepository = $entityManager->getRepository(Product::class);
        $this->session = new Session();
    }

    public function add($productId)
    {
        $this->products = $this->session->get('products');

        if(!$this->products)
        {
            $this->products = [];
        }

        array_push($this->products, $productId);
        $this->session->set('products', $this->products);
    }

    public function delete($product)
    {
        $this->products = $this->session->get('products');

        if(!$this->products)
        {
            $this->products = [];
        }

        $index = array_search($product, $this->products);
        if($index !== false)
        {
            unset($this->products[$index]);
        }
        $this->session->set('products', $this->products);
    }

    public function get()
    {
        $this->products = $this->session->get('products');

        if(!$this->products)
        {
            $this->products = [];
        }

        $products = [];
        foreach ($this->products as $productId)
        {
            array_push($products, $this->productRepository->find($productId));
        }
        return $products;
    }
}
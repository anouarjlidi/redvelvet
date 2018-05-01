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

    public function add($productId, $quantity)
    {
        $this->products = $this->session->get('products');

        if(!$this->products)
        {
            $this->products = [];
        }

        $product['quantity'] = $quantity;
        $product['id'] = $productId;

        array_push($this->products, $product);
        $this->session->set('products', $this->products);
    }

    public function delete($productId)
    {
        $this->products = $this->session->get('products');

        if(!$this->products)
        {
            return;
        }


        foreach($this->products as $key=>$element)
        {
            if ($element['id'] == $productId)
            {
                unset($this->products[$key]);
                break;
            }
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
        foreach ($this->products as $productTemp)
        {
            $product = $this->productRepository->find($productTemp['id']);
            $product->setQuantity($productTemp['quantity']);
            array_push($products, $product);
        }
        return $products;
    }
}
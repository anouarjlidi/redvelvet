<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 3/4/2018
 * Time: 12:12 PM
 */

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class Cart
{
    private $session;
    private $products;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function addProductToCart($productId)
    {
        $this->products = $this->session->get('products');

        if(!$this->products)
        {
            $this->products = [];
        }

        array_push($this->products, $productId);
        $this->session->set('products', $this->products);
    }

    public function deleteProductFromCart($product)
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

    public function getProducts(ProductRepository $productRepository)
    {
        $this->products = $this->session->get('products');

        if(!$this->products)
        {
            $this->products = [];
        }

        $products = [];
        foreach ($this->products as $productId)
        {
            array_push($products, $productRepository->find($productId));
        }
        return $products;
    }
}
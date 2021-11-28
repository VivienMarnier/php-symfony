<?php

namespace App\Entity;

use App\Entity\Product;

class Cart {

    /**
     * @var Product[]
     */
    private $products = [];

    public function addProduct(Product $product, int $qty) {
        $this->products[$product->getId()] = [
            'entity' => $product,
            'qty' => $qty
        ];
        dump($this->products);
    }

    public function removeProduct(int $productId) {
        if(array_key_exists($productId,$this->products)) {
            unset($this->products[$productId]);
        }
    }

    public function getTotal() {
        $total = 0;
        foreach($this->products as $key => $product) {
            $step = $product['qty'] * $product['entity']->getPrice();
            $total += $step;
        }
        return $total;
    }

    public function getItemsCount() {
        $count = 0 ;
        foreach($this->products as $key => $product) {
            $count += $product['qty']; 
        }
        return $count;
    }

    public function clear() {
        $this->products = [];
    }

    public function getProducts() {
        return $this->products;
    }
}
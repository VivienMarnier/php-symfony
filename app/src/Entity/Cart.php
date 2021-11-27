<?php

namespace App\Entity;

use App\Entity\Product;

class Cart {

    /**
     * @var Product[]
     */
    private $products = [];

    public function addProduct(Product $product, $qty) {
        $this->products[$product->getId()] = [
            'entity' => $product,
            'qty' => $qty
        ];
    }

    public function removeProduct(int $productId) {
        if(array_key_exists($productId,$this->products)) {
            unset($this->products[$productId]);
        }
    }

    public function getTotal() {
        $total = 0;
        foreach($this->products as $key => $product) {
            $total += $product['qty'] * $product['entity']->getPrice();
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
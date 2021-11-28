<?php

namespace App\Entity;

use App\Entity\Product;

/**
 * 
 */
class Cart {

    /**
     * @var Product[]
     */
    private $products = [];
    
    /**
     * addProduct
     *
     * @param  mixed $product
     * @param  mixed $qty
     * @return void
     */
    public function addProduct(Product $product, int $qty) {
        $this->products[$product->getId()] = [
            'entity' => $product,
            'qty' => $qty
        ];
    }
  
    /**
     * removeProduct
     *
     * @param  mixed $productId
     * @return void
     */
    public function removeProduct(int $productId) {
        if(array_key_exists($productId,$this->products)) {
            unset($this->products[$productId]);
        }
    }
    
    /**
     * getTotal
     *
     * @return float
     */
    public function getTotal(): float {
        $total = 0;
        foreach($this->products as $key => $product) {
            $step = $product['qty'] * $product['entity']->getPrice();
            $total += $step;
        }
        return $total;
    }
       
    /**
     * getItemsCount
     *
     * @return int
     */
    public function getItemsCount(): int {
        $count = 0 ;
        foreach($this->products as $key => $product) {
            $count += $product['qty']; 
        }
        return $count;
    }
    
    /**
     * clear products
     *
     * @return void
     */
    public function clear() {
        $this->products = [];
    }
    
    /**
     * getProducts
     *
     * @return void
     */
    public function getProducts() {
        return $this->products;
    }
}
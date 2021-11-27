<?php

namespace App\Tests\Entity;

use App\Entity\Cart;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testCartTotal(): void
    {
        // Arrange
        $expectedTotal = 43.95;
        $cart = new Cart();

        $product1 = new Product();
        $product1->setName('product 1');
        $product1->setPrice(15.99);

        $product2 = new Product();
        $product2->setName('product 2');
        $product2->setPrice(3.99);

        $cart->addProduct($product1, 2);
        $cart->addProduct($product2, 3);

        // Act
        $total = $cart->getTotal();
        
        // Assert
        $this->assertEquals($expectedTotal,$total);
    }
}

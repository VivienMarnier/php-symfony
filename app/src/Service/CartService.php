<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\Product;
use DomainException;
use Exception;
use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class CartService
{
    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var Cart
     */
    protected $cart;
    
    /**
     * __construct
     *
     * @param  mixed $requestStack
     * @param  mixed $kernel
     * @return void
     */
    public function __construct(RequestStack $requestStack,KernelInterface $kernel) {
        $this->init($requestStack, $kernel);
    }
    
    /**
     * init
     *
     * @param  mixed $requestStack
     * @param  mixed $kernel
     * @return void
     */
    private function init(RequestStack $requestStack,$kernel) {
        try {
            $this->session = $requestStack->getSession();
        }
        catch(SessionNotFoundException $e) {
            // Get session from kernel if no request stack available
            $this->session = $kernel->getContainer()->get('session'); 
        }
    }
   
    /**
     * Retrieves the cart from session
     *
     * @return Cart
     */
    public function getCart(): Cart {
        return $this->session->get('cart', new Cart());
    }
  
    /**
     * getTotalCartAmount
     *
     * @return float
     */
    public function getTotalCartAmount(): float {
        $cart = $this->session->get('cart',new Cart());
        return $cart->getTotal();
    }

    /**
     * Retrieves the total number of items in the cart 
     * @return int
     */
    public function getCartItemsCount(): int {
        $cart = $this->session->get('cart',new Cart());
        return $cart->getItemsCount();
    }
  
    /**
     * Add product or update product quantity from cart
     *
     * @param  mixed $product
     * @param  mixed $qty
     * @return void
     */
    public function addProduct(Product $product, int $qty) {
        $cart = $this->session->get('cart', new Cart());
        $cart->addProduct($product, $qty);
        $this->session->set('cart', $cart);
    }
    
    /**
     * Remove product from cart
     *
     * @param  mixed $productId
     * @return void
     */
    public function removeProduct(int $productId) {
        $cart = $this->session->get('cart');
        $cart->removeProduct($productId);
        $this->session->set('cart', $cart);
    }
    
    /**
     * clearCart
     *
     * @return void
     */
    public function clearCart() {
        $cart = $this->session->get('cart');
        $cart->clear();
        $this->session->set('cart', $cart);
    }
}
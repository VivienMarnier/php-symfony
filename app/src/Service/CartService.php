<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\Product;
use DomainException;
use Exception;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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

    public function __construct(RequestStack $requestStack) {
        $this->session = $requestStack->getSession();
    }

    /**
     * Retrieves the cart from session
     */
    public function getCart() {
        return $this->session->get('cart', new Cart());
    }

    /**
     * Retrieves the total amount of the cart
     */
    public function getTotalCartAmount() {
        $cart = $this->session->get('cart');
        return $cart->getTotal();
    }

    /**
     * Retrieves the total number of items in the cart 
     */
    public function getCartItemsCount() {
        $cart = $this->session->get('cart');
        return $cart->getCartItemsCount();
    }

    /**
     * Add product or update product quantity from cart 
     */
    public function addProduct(Product $product, int $qty) {
        $cart = $this->session->get('cart', new Cart());
        $cart->addProduct($product, $qty);
        $this->session->set('cart', $cart);
    }

    /**
     * Remove product from cart
     */
    public function removeProduct(int $productId) {
        $cart = $this->session->get('cart');
        $cart->removeProduct($productId);
        $this->session->set('cart', $cart);
    }

    public function clearCart() {
        $cart = $this->session->get('cart');
        $cart->clear();
        $this->session->set('cart', $cart);
    }
}
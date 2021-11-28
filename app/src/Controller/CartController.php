<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
        /**
     * @var CartService
     */
    protected $cartService;

    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }

    #[Route('/cart', name: 'cart')]
    public function index(CartService $cartService): Response
    {
        $cart = $cartService->getCart();
        $total = $cartService->getTotalCartAmount();
        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'total' =>$total
        ]);
    }

    #[Route('/cart/remove/product/{id}', name: 'remove_product_cart')]
    public function removeProduct(int $id) {
        $this->cartService->removeProduct($id);
        $this->addFlash('success','Product has been succesfully removed from your cart.');
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/clear', name: 'clear_cart')]
    public function clear(){
        $this->cartService->clearCart();
        $this->addFlash('success','Your cart has been succesfully cleared.');
        return $this->redirectToRoute('index');
    }
}

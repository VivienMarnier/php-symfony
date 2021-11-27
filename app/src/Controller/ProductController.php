<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductCartType;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    /**
     * @var CartService
     */
    protected $cartService;

    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }

    #[Route('/product/{id}', name: 'product_view')]
    public function view(int $id, Request $request): Response
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $product = $productRepository->find($id);

        if(!$product) {
            throw $this->createNotFoundException('The product does not exist');
        }

        $form = $this->createForm(ProductCartType::class);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();
            $this->cartService->addProduct($product,$datas['product_qty']);
            $this->addFlash('success','Product has been succesfully added to your cart.');
            return $this->redirectToRoute('index');
        }


        return $this->renderForm('product/view.html.twig', [
            'product' => $product,
            'form' => $form
        ]);
    }
}

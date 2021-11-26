<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketService
{
    /**
     * @var SessionInterface
     */
    protected $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    /**
     * Get the total amount of the basket
     */
    public function getTotal() {

        return 50.56;
    }

    public function addProduct() {

    }

    public function removeProduct() {

    }

    public function updateProductQty() {

    }
}
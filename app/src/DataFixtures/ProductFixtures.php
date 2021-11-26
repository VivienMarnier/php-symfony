<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = [
            'Curabitur',
            'Porttitor',
            'Bibendum',
            'Sodales',
            'Facilisis',
            'Eget',
            'Pharetra',
            'Scelerisque',
            'Etiam',
            'Mollis',
            'Praesent vel',
            'Finibus'
        ];

        for($i = 0; $i < 12; $i++) {
            $product = new Product();
            // Name
            $product->setName($names[$i]);
            // Description
            $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida pulvinar enim, eget sagittis tortor cursus mollis. Fusce sed tortor ante. Mauris vitae velit in mi ultrices pretium. Proin convallis.";
            $product->setDescription($description);
            // Price
            $price = mt_rand(1250,5370) / 100;
            $product->setPrice($price);

            $manager->persist($product);
        }

        $manager->flush();
    }
}

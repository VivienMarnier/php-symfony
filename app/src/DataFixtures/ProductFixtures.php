<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            'Curabitur' => 'bananas.png',
            'Porttitor' => 'camcorder.png',
            'Bibendum' => 'camera.png',
            'Sodales' => 'car.jpg',
            'Facilisis' => 'checklist.png',
            'Eget' => 'cheese.png',
            'Pharetra' => 'cherries.png',
            'Scelerisque' => 'clapperboard.png',
            'Etiam' => 'compact-cassette.png',
            'Mollis' => 'hamburger.png',
            'Praesent vel' => 'monitor.png',
            'Finibus' => 'vhs.png'
        ];

        foreach($products as $name => $image) {
            $product = new Product();
            // Name
            $product->setName($name);
            // Description
            $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida pulvinar enim, eget sagittis tortor cursus mollis. Fusce sed tortor ante. Mauris vitae velit in mi ultrices pretium. Proin convallis.";
            $product->setDescription($description);
            // Price
            $price = mt_rand(1250,5370) / 100;
            $product->setPrice($price);

            // Image
            $product->setImage($image);

            $manager->persist($product);
        }

        $manager->flush();
    }
}

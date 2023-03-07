<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $product = new Product();
        $product->setPrice(1450,20)->setName("Iphone 14")->setDescription("NUL")->setBarcode("25558")->setCategory($this->getReference(CategoryFixtures::TELEPHONE_REFERENCE));
        $manager->persist($product);

        $product = new Product();
        $product->setPrice(1250,20)->setName("Ipad")->setDescription("NUL")->setBarcode("25558")->setCategory($this->getReference(CategoryFixtures::TELEPHONE_REFERENCE));
        $manager->persist($product);

        $product = new Product();
        $product->setPrice(550,20)->setName("Xbox")->setDescription("NUL")->setBarcode("25558")->setCategory($this->getReference(CategoryFixtures::TELEPHONE_REFERENCE));
        $manager->persist($product);

        $product = new Product();
        $product->setPrice(2450,20)->setName("LG")->setDescription("NUL")->setBarcode("25558")->setCategory($this->getReference(CategoryFixtures::TELEPHONE_REFERENCE));
        $manager->persist($product);
        
        

        $manager->flush();
    }
}

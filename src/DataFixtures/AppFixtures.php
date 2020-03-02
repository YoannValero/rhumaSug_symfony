<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $produit = new Produit();
        $produit->setLibelle('Cafe');
        $produit->setImg('https://via.placeholder.com/150');

        $produit1 = new Produit();
        $produit1->setImg('https://via.placeholder.com/150');
        $produit1->setLibelle('Rhum45');

        $produit2 = new Produit();
        $produit2->setLibelle('Rhum50');
        $produit2->setImg('https://via.placeholder.com/150');
        
        
        $manager->persist($produit);
        $manager->persist($produit1);
        $manager->persist($produit2);

      
        $manager->flush();
    }
}

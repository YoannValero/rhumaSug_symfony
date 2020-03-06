<?php

namespace App\Controller;


use App\Entity\Produit;
use App\Entity\Panier;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class PanierController extends AbstractController
{
    /**
     * @Route("/panier/{id}", name="panier")
     */
    public function index(Produit $produit, PanierRepository $panierRepository)
    {

        $manager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        
        $panierRepository = $manager->getRepository(Panier::class)->findOneBy(["user" => $user, "produit" => $produit]);

        // To add 1 same product in cart
        if ($panierRepository) {
            $qteProduit = $panierRepository->getQuantite();
            $addOneQte = $panierRepository->setQuantite(($qteProduit + 1));
            $manager->persist($addOneQte);
        } else {
        // dd($panierRepository->getQuantite());
        
        $panier = new Panier();
        $panier->setUser($user)
               ->setProduit($produit)
               ->setQuantite(1);
        
        $manager->persist($panier);
        }
        $manager->flush();
        

        return $this->redirectToRoute('show_panier');
    }

    /**
     * @Route("/panier", name="show_panier")
     */
    public function show_panier(PanierRepository $panierRepository) {

        return $this->render('panier/index.html.twig', [
            'paniers' => $panierRepository->findBy(['user' => $this->getUser()])
        ]);
    }

    /**
     * @Route("/panier_delete{id}", name="delete_panier")
     */
    public function delete($id) {

        $manager = $this->getDoctrine()->getManager();
        $panier = $manager->getRepository(Panier::class)->find($id);
        if ($panier) {
            $manager->remove($panier);
            $manager->flush();
        }
        return $this->redirectToRoute("show_panier");
    }


   
}

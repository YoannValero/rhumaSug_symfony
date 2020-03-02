<?php

namespace App\Controller;


use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil() {
        return $this->render('main/accueil.html.twig');
    }
      /**
     * @Route("/produits", name="produits")
     */
    public function produit(ProduitRepository $produitRepository) {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll()
        ]);
    }
      /**
     * @Route("/contact", name="contact")
     */
    public function contact() {
        return $this->render('contact/index.html.twig');
    }

     /**
     * @Route("/profile", name="profile")
     */
    public function profile(UserRepository $userRepository) {
        return $this->render('main/profile.html.twig', [
            'user' => $userRepository->findAll()
        ]);
    }
    
}

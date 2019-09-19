<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(OfferRepository $offerRepository)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'last_offers' => $offerRepository->getNLast(10),
        ]);
    }
}

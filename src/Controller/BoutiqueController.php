<?php

namespace App\Controller;

use App\Service\BoutiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BoutiqueController extends AbstractController
{
    #[Route(path:'/boutique', name: 'app_boutique')]
    public function index(BoutiqueService $boutiqueService): Response
    {
        $categories = $boutiqueService->findAllCategories();
        return $this->render('boutique/index.html.twig', [
            'categories' => $categories,
        ]);
    }


    #[Route(path:'/rayon/{idCategory}', name: 'app_boutique_rayon')]
    public function rayon(BoutiqueService $boutiqueService, int $idCategory): Response
    {
        $category = $boutiqueService->findCategorieById($idCategory);
        $produits = $boutiqueService->findProduitsByCategorie($idCategory);
        return $this->render('boutique/rayon.html.twig', [
            'produits' => $produits,
            'category' => $category,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Painting;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaintingController extends AbstractController
{
    /**
     * @Route("/painting", name="paintings")
     */
    public function index(): Response
    {
        $paintingRepository = $this->getDoctrine()->getRepository(Painting::class);
        $paintings = $paintingRepository->findBy(
            ['disponibility' => 'true'],
            ['name' => 'ASC']
        );
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $categoryRepository->findAll();

        return $this->render('painting/index.html.twig', [
            'paintings'     => $paintings,
            'categories'     => $categories,
        ]);
    }

    /**
     * @Route("/painting/{id}", name="painting_show")

     */
    public function showPainting(Painting $painting): Response
    {
        if (!$painting) {
            return $this->redirectToRoute('paintings');
        }
        return $this->render('painting/show.html.twig', [
            'painting' => $painting,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Painting;
use App\Entity\GeneralRequest;
use App\Form\GeneralRequestType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(Request $request): Response
    {
        $paintingRepository = $this->getDoctrine()->getRepository(Painting::class);
        $paintings = $paintingRepository->findBy(
            ['disponibility' => 'true'],
            ['name' => 'ASC']
        );
        $lessonRepository = $this->getDoctrine()->getRepository(Lesson::class);
        $lessons = $lessonRepository->findAll();

        $generalRequestRepository = $this->getDoctrine()->getRepository(GeneralRequest::class);
        $generalRequests = $generalRequestRepository->findAll();
        
        $generalRequest = new GeneralRequest();

        $form = $this->createForm(GeneralRequestType::class, $generalRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $generalRequest = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($generalRequest);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }


        return $this->render('home/index.html.twig', [
            'paintings'     => $paintings,
            'lessons'     => $lessons,
            'formGeneralRequest'  => $form->createView(),
            'generalRequests'     => $generalRequests,
        ]);
    }

    /**
     * @Route("/", name="index"): Response
     */
    public function index()
    {       
        return $this->redirectToRoute('home');
       
    }

    /**
     * @Route("/home/artist", name="about_artist")
     */
    public function artist(): Response
    {
        return $this->render('home/artist.html.twig');
    }
}

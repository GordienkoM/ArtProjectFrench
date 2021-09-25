<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Lesson;
use App\Entity\Painting;
use App\Repository\CourseRepository;
use App\Repository\LessonRepository;
use App\Repository\PaintingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $session, PaintingRepository $paintingRepository,
                    LessonRepository $lessonRepository, CourseRepository $courseRepository)
    {
        
        //on recupère les données des painers dans la session        
        $paintingCart = $session->get("paintingCart", []);
        $lessonCart = $session->get("lessonCart", []);
        $courseCart = $session->get("courseCart", []);

        //on initialise le contenu des paniers et total
        $dataPaintingCart = [];
        $dataLessonCart = [];
        $dataCourseCart = [];
        $total = 0;

        //on parcours le panier des tableaux et forme des donnés qu'on transmets à la vue 
        foreach ($paintingCart as $type => $painting) {
            foreach ($painting as $id => $quantity) {
                $painting = $paintingRepository->find($id);
                $dataPaintingCart[] = [
                    "type" => $type,
                    "painting" => $painting,
                    "quantity" => $quantity
                ];
            }
        }
        
        //on calcul le total en ajoutant le coût des tableaux du panier 
        foreach($dataPaintingCart as $item){
            $totalItem = $item['painting']->getPriceOriginal() * $item['quantity'];
            $total += $totalItem;
        }

        //on parcours le panier des leçons, form des donnés qu'on transmets à la vue et calcul le total
        foreach($lessonCart as $id => $quantity){
            $lesson = $lessonRepository->find($id);
            $total += $lesson->getPrice();
            $dataLessonCart[] = $lesson;
        }

        //on parcours le panier des cours, form des donnés qu'on transmets à la vue et calcul le total
        foreach($courseCart as $id => $quantity){
            $course = $courseRepository->find($id);
            $total += $course->getPrice();
            $dataCourseCart[] = $course;
        }


        return $this->render('cart/index.html.twig', [
            "paintingItems" => $dataPaintingCart,
            "lessonItems" => $dataLessonCart,
            "courseItems" => $dataCourseCart,
            "total" => $total
        ]);
    }

    /**
     * @Route("/cart/painting/add/{id}/{type}", name="cart_painting_add")
     */
    public function addPainting(Painting $painting, $type, SessionInterface $session)
    {
        if($painting){
            // on récupère le panier des tableau actuel
            $paintingCart = $session->get("paintingCart", []);
            $id = $painting->getId();
            // on met à jour la quantité du tableau ou elle passe à 1 si le tableau n'y était pas encore
            if(!empty($paintingCart[$type][$id]) && $type!='Original'){
                $paintingCart[$type][$id]++;
            }else{
                $paintingCart[$type][$id] = 1;
            }

            
            // on sauvegarde le panier des tableau dans la session
            $session->set("paintingCart", $paintingCart);
            //dd($paintingCart);
        }
        
        return $this->redirectToRoute("cart");
    }


    /**
     * @Route("/cart/painting/remove/{id}/{type}", name="cart_painting_remove")
     */
    public function removePainting($id, $type, SessionInterface $session)
    {
        // on récupère le panier des tableaux actuel
        $paintingCart = $session->get("paintingCart", []);

        if(!empty($paintingCart[$type][$id])){
            if($paintingCart[$type][$id] > 1){
                $paintingCart[$type][$id]--;
            }else{
                unset($paintingCart[$type][$id]);
            }
        }

        // on sauvegarde dans la session
        $session->set("paintingCart", $paintingCart);

        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/painting/delete/{id}/{type}", name="cart_painting_delete")
     */
    public function deletePainting($id, $type, SessionInterface $session)
    {
        // on récupère le panier des tableaux actuel
        $paintingCart = $session->get("paintingCart", []);

        if(!empty($paintingCart[$type][$id])){
            unset($paintingCart[$type][$id]);
        }

        // on sauvegarde dans la session
        $session->set("paintingCart", $paintingCart);

        return $this->redirectToRoute("cart");
    }


    /**
     * @Route("/cart/lesson/add/{id}", name="cart_lesson_add")
     */
    public function addLesson(Lesson $lesson, SessionInterface $session)
    {
        if ($lesson) {
            // on récupère le panier des leçons actuel
            $lessonCart = $session->get("lessonCart", []);
            $id = $lesson->getId();
            $lessonCart[$id] = 1;

            // on sauvegarde dans la session
            $session->set("lessonCart", $lessonCart);
        }
        
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/lesson/delete/{id}", name="cart_lesson_delete")
     */
    public function deleteLesson(Lesson $lesson, SessionInterface $session)
    {
        // on récupère le panier des leçons actuel
        $lessonCart = $session->get("lessonCart", []);
        $id = $lesson->getId();

        if(!empty($lessonCart[$id])){
            unset($lessonCart[$id]);
        }

        // on sauvegarde dans la session
        $session->set("lessonCart", $lessonCart);

        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/course/add/{id}", name="cart_course_add")
     */
    public function addCourse(Course $course, SessionInterface $session)
    {
        if ($course) {
            // on récupère le panier des cours actuel
            $courseCart = $session->get("courseCart", []);
            $id = $course->getId();
            $courseCart[$id] = 1;

            // on sauvegarde dans la session
            $session->set("courseCart", $courseCart);
        }
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/course/delete/{id}", name="cart_course_delete")
     */
    public function deleteCourse(Course $course, SessionInterface $session)
    {
        // on récupère le panier des cours actuel
        $courseCart = $session->get("courseCart", []);
        $id = $course->getId();

        if(!empty($courseCart[$id])){
            unset($courseCart[$id]);
        }

        // on sauvegarde dans la session
        $session->set("courseCart", $courseCart);

        return $this->redirectToRoute("cart");
    }


    /**
     * @Route("/cart/delete", name="cart_delete_all")
     */
    public function deleteAll(SessionInterface $session)
    {
        //on suprime tous les paniers
        $session->remove("paintingCart");
        $session->remove("lessonCart");
        $session->remove("courseCart");

        return $this->redirectToRoute("cart");
    }
}

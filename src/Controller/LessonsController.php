<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Lesson;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LessonsController extends AbstractController
{
    /**
     * @Route("/lesson", name="lessons_cours")
     */
    public function index(): Response
    {
        $lessonRepository = $this->getDoctrine()->getRepository(Lesson::class);
        $lessons = $lessonRepository->findAll();
        $courseRepository = $this->getDoctrine()->getRepository(Course::class);
        $courses = $courseRepository->findAll();
        return $this->render('lessons/index.html.twig', [
           'lessons'     => $lessons,
           'courses'     => $courses,
        ]);
    }


    /**
     * @Route("/lesson/{id}", name="lesson_show", methods="GET")
     */
    public function showLesson(Lesson $lesson): Response
    {
        return $this->render('lessons/showLesson.html.twig', [
            'lesson' => $lesson,
        ]);
    }

    /**
     * @Route("/course/{id}", name="course_show", methods="GET")
     */
    public function showcourse(Course $course): Response
    {
        return $this->render('lessons/showCourse.html.twig', [
            'course' => $course,
        ]);
    }
}
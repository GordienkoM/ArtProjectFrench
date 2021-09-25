<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Lesson;
use App\Entity\KeyWord;
use App\Entity\Category;
use App\Entity\Painting;
use App\Form\CourseType;
use App\Form\LessonType;
use App\Form\KeyWordType;
use App\Form\CategoryType;
use App\Form\PaintingType;
use App\Entity\OrderRequest;
use App\Entity\PaintingImage;
use App\Entity\GeneralRequest;
use App\Form\PaintingImageType;
use App\Form\GeneralRequestAdminType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin/painting/edit/{id}", name="painting_edit")
     * @Route("/admin/painting", name="painting_add")
     */
    public function paintings(Painting $painting = NULL, Request $request)
    {
        $paintingRepository = $this->getDoctrine()->getRepository(Painting::class);
        $paintings = $paintingRepository->findAll();

        //si painting n'existe pas, on instancie un nouveau painting (le cas d'un ajout)
       if (!$painting) {
            $painting = new Painting();
        }

        $form = $this->createForm(PaintingType::class, $painting);
        $form->handleRequest($request);

        //si on soumet le formulaire et que le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les données du formulaire
            $painting = $form->getData();
            //on ajoute un nouveau tableau
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($painting);
            $entityManager->flush();

            return $this->redirectToRoute('painting_add');
        }

        return $this->render('admin/paintings.html.twig', [
            'formPainting'  => $form->createView(),
            'paintings'     => $paintings,
            // si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)
            'editMode' => $painting->getId() !== null 

        ]);
    }


    /**
     * @Route("/admin/painting/del/{id}",name="painting_delete")  
     */
    public function deletePainting(Painting $painting = NULL)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($painting);
        $entityManager->flush();

        return $this->redirectToRoute('painting_add');
    }

    /** 
     * @Route("/admin/category", name="categories")
     */
    public function categories(Request $request)
    {
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $categoryRepository->findAll();
        
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('categories');
        }

        return $this->render('admin/categories.html.twig', [
            'formCategory'  => $form->createView(),
            'categories'     => $categories,

        ]);
    }


    /**
     * @Route("/admin/category/del/{id}",name="category_delete")  
     */
    public function deleteCategory(Category $category = NULL /*grace à ParamConvecter*/)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();
        //$this->addFlash("success", "Категория удалена");
        return $this->redirectToRoute('categories');
    }

    /** 
     * @Route("/admin/keyWord", name="keyWords")
     */
    public function keyWords(Request $request)
    {
        $keyWordRepository = $this->getDoctrine()->getRepository(KeyWord::class);
        $keyWords = $keyWordRepository->findAll();
        
        $keyWord = new KeyWord();

        $form = $this->createForm(KeyWordType::class, $keyWord);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyWord = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($keyWord);
            $entityManager->flush();

            return $this->redirectToRoute('keyWords');
        }

        return $this->render('admin/keyWords.html.twig', [
            'formKeyWord'  => $form->createView(),
            'keyWords'     => $keyWords,

        ]);
    }

    /**
     * @Route("/admin/keyWord/del/{id}",name="keyWord_delete")  
     */
    public function deletekeyWord(KeyWord $keyWord = NULL )
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($keyWord);
        $entityManager->flush();
        $this->addFlash("success", "Ключевое слово удалено");
        return $this->redirectToRoute('keyWords');
    }

    /** 
     * @Route("/admin/paintingImage", name="paintingImages")
     */
    public function paintingImages(Request $request)
    {
        $paintingImageRepository = $this->getDoctrine()->getRepository(PaintingImage::class);
        $paintingImages = $paintingImageRepository->findAll();
        
        $paintingImage = new PaintingImage();

        $form = $this->createForm(PaintingImageType::class, $paintingImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paintingImage = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paintingImage);
            $entityManager->flush();

            return $this->redirectToRoute('paintingImages');
        }

        return $this->render('admin/paintingImages.html.twig', [
            'formPaintingImage'  => $form->createView(),
            'paintingImages'     => $paintingImages,

        ]);
    }

    /**
     * @Route("/admin/paintingImage/del/{id}",name="paintingImage_delete")  
     */
    public function deletePaintingImage(PaintingImage $paintingImage = NULL )
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($paintingImage);
        $entityManager->flush();
        //$this->addFlash("success", "Ключевое слово удалено");
        return $this->redirectToRoute('paintingImages');
    }

    /**
     * @Route("/admin/lesson/edit/{id}", name="lesson_edit")
     * @Route("/admin/lesson", name="lesson_add")
     */
    public function lessons(Lesson $lesson = NULL, Request $request)
    {
        $lessonRepository = $this->getDoctrine()->getRepository(Lesson::class);
        $lessons = $lessonRepository->findAll();

        //si lesson n'existe pas, on instancie un nouveau lesson (le cas d'un ajout)
       if (!$lesson) {
            $lesson = new Lesson();
        }

        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        //si on soumet le formulaire et que le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les données du formulaire
            $lesson = $form->getData();
            //on ajoute un nouveau tableau
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lesson);
            $entityManager->flush();

            return $this->redirectToRoute('lesson_add');
        }

        return $this->render('admin/lessons.html.twig', [
            'formLesson'  => $form->createView(),
            'lessons'     => $lessons,
            'editMode' => $lesson->getId() !== null // si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)

        ]);
    }


    /**
     * @Route("/admin/lesson/del/{id}",name="lesson_delete")  
     */
    public function deleteLesson(Lesson $lesson = NULL)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($lesson);
        $entityManager->flush();

        return $this->redirectToRoute('lesson_add');
    }



    /**
     * @Route("/admin/course/edit/{id}", name="course_edit")
     * @Route("/admin/course", name="course_add")
     */
    public function courses(Course $course = NULL, Request $request)
    {
        $courseRepository = $this->getDoctrine()->getRepository(Course::class);
        $courses = $courseRepository->findAll();

        //si course n'existe pas, on instancie un nouveau course (le cas d'un ajout)
       if (!$course) {
            $course = new Course();
        }

        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        //si on soumet le formulaire et que le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les données du formulaire
            $course = $form->getData();
            //on ajoute un nouveau tableau
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirectToRoute('course_add');
        }

        return $this->render('admin/courses.html.twig', [
            'formCourse'  => $form->createView(),
            'courses'     => $courses,
            'editMode' => $course->getId() !== null // si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)

        ]);
    }


    /**
     * @Route("/admin/course/del/{id}",name="course_delete")  
     */
    public function deletecourse(Course $course = NULL)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($course);
        $entityManager->flush();

        return $this->redirectToRoute('course_add');
    }


    /**
     * @Route("/admin/request/general/edit/{id}", name="general_request_edit")
     * @Route("/admin/request", name="requests")
     */
    public function generalRequest(GeneralRequest $generalRequest = NULL, Request $request): Response
    {
        $generalRequestRepository = $this->getDoctrine()->getRepository(GeneralRequest::class);
        $generalRequests = $generalRequestRepository->findAll();
        // $orderRequestRepository = $this->getDoctrine()->getRepository(OrderRequest::class);
        // $orderRequests = $orderRequestRepository->findAll();

        if ($generalRequest){
            $editGeneralRequestId = $generalRequest->getId();        

            $form = $this->createForm(GeneralRequestAdminType::class, $generalRequest);
            $form->handleRequest($request);
            $formGeneralRequest = $form->createView();

            //si on soumet le formulaire et que le form est valide
            if ($form->isSubmitted() && $form->isValid()) {
                //on récupère les données du formulaire
                $generalRequest = $form->getData();
                //on ajoute une demande
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($generalRequest);
                $entityManager->flush();

                return $this->redirectToRoute('requests');
            }
        }else{
            $editGeneralRequestId = NULL;
            $formGeneralRequest = NULL;
            }

        return $this->render('admin/requests.html.twig', [
            // 'orderRequests'     => $orderRequests,
            'generalRequests'     => $generalRequests,
            'formGeneralRequest'  => $formGeneralRequest,
            'editGeneralRequestId' => $editGeneralRequestId //id de demande à éditer
        ]);
    }

    /**
     * @Route("/admin/request/general/del/{id}",name="general_request_delete")  
     */
    public function deleteGeneralRequest(GeneralRequest $generalRequest = NULL)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($generalRequest);
        $entityManager->flush();

        return $this->redirectToRoute('requests');
    }
}

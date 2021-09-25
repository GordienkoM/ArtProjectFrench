<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Lesson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label_format' => 'Titre de leçon',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('price', TextType::class, [
                'label_format' => 'Prix de leçon',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('description', TextType::class, [
                'label_format' => 'Description',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('image', TextType::class, [
                'label_format' => 'Image',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('video', TextType::class, [
                'label_format' => 'Vidéo',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('lessons', EntityType::class, [
                'label_format' => 'Leçons',
                'class'         => Lesson::class,
                'choice_label'  => 'title',
                'attr'          => ['class' => 'uk-textarea'],
                'multiple'      => true,
                //permet d'étaler l'affichage en cases à cocher.
                'expanded'      => true,
                'by_reference' => false,              
                ])
            ->add('submit', SubmitType::class, [
                'label_format' => 'Ajouter',
                'attr' => ['class' => 'uk-button uk-button-secondary uk-margin-top']
            ]);
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}

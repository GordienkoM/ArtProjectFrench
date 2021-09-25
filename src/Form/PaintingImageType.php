<?php

namespace App\Form;

use App\Entity\PaintingImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PaintingImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, [
            'label_format' => 'Image de tableau',
            'attr' => ['class' => 'uk-input']
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
            'data_class' => PaintingImage::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\KeyWord;
use App\Entity\Category;
use App\Entity\Painting;
use App\Entity\PaintingImage;
use Symfony\Component\Form\AbstractType;
use App\Repository\PaintingImageRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PaintingType extends AbstractType
{
    private $repository;
    public function __construct(PaintingImageRepository $r)
    {
        $this->repository = $r;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label_format' => 'Nom de tableau',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('discription', TextType::class, [
                'label_format' => 'Description',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('galleryImage', TextType::class, [
                'label_format' => 'Image principale',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('disponibility', ChoiceType::class, [
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'label_format' => 'Afficher dans la galerie',
                'attr' => ['class' => 'uk-select']
            ])
            ->add('saled', ChoiceType::class, [
                'choices'  => [
                    'Oui' => false,
                    'Non' => true,                 
                ],
                'label_format' => 'Original est en stock',
                'attr' => ['class' => 'uk-select']
            ]) 
            ->add('priceOriginal', IntegerType::class, [
                'label_format' => "Prix d'original",
                'attr' => ['class' => 'uk-input']
            ])
            ->add('priceOriginalSale', IntegerType::class, [
                'label_format' => "Prix d'original avec le solde",
                'attr' => ['class' => 'uk-input']
            ])
            ->add('priceReproduction', IntegerType::class, [
                'label_format' => 'Prix de la reproduction',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('priceReproductionSale', IntegerType::class, [
                'label_format' => 'Prix de la reproduction avec le solde',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('priceFresco', IntegerType::class, [
                'label_format' => 'Prix du fresco',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('priceFrescoSale', IntegerType::class, [
                'label_format' => 'Prix du fresco avec la solde',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('creationYear', TextType::class, [
                'label_format' => "L'année de création",
                'attr' => ['class' => 'uk-input']
            ])
            ->add('hight', TextType::class, [
                'label_format' => 'hauteur',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('width', TextType::class, [
                'label_format' => 'Largeur',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('material', TextType::class, [
                'label_format' => 'Materiel',
                'attr' => ['class' => 'uk-input']
            ])

            ->add('categories', EntityType::class, [
                'label_format' => 'Catégorie',
                'class'         => Category::class,
                'choice_label'  => 'name',
                'attr'          => ['class' => 'uk-input'],
                //permet d'afficher plusieurs categories dans un champ
                'multiple'      => true,
                //pour selectioner plusier categorie pour le tableau
                'expanded'      => true, 
                // 'by_reference' => false,             
                ])

            ->add('keyWords', EntityType::class, [
                'label_format' => 'Mot clé',
                'class'         => KeyWord::class,
                'choice_label'  => 'name',
                'attr'          => ['class' => 'uk-textarea'],
                'multiple'      => true,
                //permet d'étaler l'affichage en cases à cocher.
                'expanded'      => true,
                // 'by_reference' => false,              
                ])

            ->add('paintingImages', EntityType::class, [
                'label_format' => 'Images de tableau',
                'class'         => PaintingImage::class,
                'choice_label'  => 'name',
                'attr'          => ['class' => 'uk-textarea'],
                'multiple'      => true,
                //permet d'étaler l'affichage en cases à cocher.
                'expanded'      => true,
                'by_reference' => false,      
                'choices' => $this->repository->findAvailablePaintingImages(),
                
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
            'data_class' => Painting::class,
        ]);
    }
}

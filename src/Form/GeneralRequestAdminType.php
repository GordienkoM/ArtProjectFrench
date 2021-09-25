<?php

namespace App\Form;

use App\Entity\GeneralRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GeneralRequestAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'label_format' => 'Traité',
                'attr' => ['class' => 'uk-select']
            ])
            ->add('adminComment')
            ->add('name', TextType::class, [
                'label_format' => 'Nom',
                'attr' => ['class' => 'uk-input']
            ])
            ->add('phone', TextType::class, [
                'label_format' => 'Téléphone',
                'attr' => ['class' => 'uk-input']
            ])

            ->add('submit', SubmitType::class, [
                'label_format' => 'Appliquer',
                'attr' => ['class' => 'uk-button uk-button-secondary']
            ]);
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GeneralRequest::class,
        ]);
    }
}

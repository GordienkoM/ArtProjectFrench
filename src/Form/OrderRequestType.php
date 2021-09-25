<?php

namespace App\Form;

use App\Entity\OrderRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status')
            ->add('firstName')
            ->add('lastName')
            ->add('adress')
            ->add('postCode')
            ->add('city')
            ->add('country')
            ->add('phone')
            ->add('email')
            ->add('adminComment')
            ->add('createdAt')
            ->add('courses')
            ->add('lessons')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrderRequest::class,
        ]);
    }
}

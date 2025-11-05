<?php
// src/Form/JewelrySearchType.php

namespace App\Form;

use App\Entity\Gemtype;
use App\Entity\Jewelrytype;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class JewelrySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('gemtype', EntityType::class, [
            'class' => Gemtype::class,
            'choice_label' => 'name',
            'placeholder' => 'Select gem type',
            'required' => false,
        ])
        ->add('jewelrytype', EntityType::class, [
            'class' => Jewelrytype::class,
            'choice_label' => 'name',
            'placeholder' => 'Select jewelry type',
            'required' => false,
        ]);
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'method' => 'GET',
        ]);
    }
    public function getBlockPrefix(): string
    {
        return 'jewelry_search';
    }


}

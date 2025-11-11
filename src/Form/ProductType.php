<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Gemtype;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        // Connected dropdown for gemtype
        ->add('gemtype', EntityType::class, [
            'class' => Gemtype::class,
            'choice_label' => 'name',
            'placeholder' => 'Select a gem type',
            'attr' => ['class' => 'border rounded p-2 w-full'],
        ])

        // Dropdowns for all other fields
        ->add('carat', ChoiceType::class, [
            'choices' => [
                '0.5' => '0.5',
                '1.0' => '1.0',
                '1.5' => '1.5',
                '2.0' => '2.0',
            ],
            'placeholder' => 'Select carat',
            'attr' => ['class' => 'border rounded p-2 w-full'],
        ])
        ->add('size', ChoiceType::class, [
            'choices' => [
                '5mm' => '5mm',
                '10mm' => '10mm',
                '15mm' => '15mm',
            ],
            'placeholder' => 'Select size',
            'attr' => ['class' => 'border rounded p-2 w-full'],
        ])
        ->add('cut', ChoiceType::class, [
            'choices' => [
                'Round' => 'Round',
                'Princess' => 'Princess',
                'Brilliant' => 'Brilliant',
                'Oval' => 'Oval',
            ],
            'placeholder' => 'Select cut',
            'attr' => ['class' => 'border rounded p-2 w-full'],
        ])
        ->add('color', ChoiceType::class, [
            'choices' => [
                'Red' => 'Red',
                'Blue' => 'Blue',
                'Green' => 'Green',
                'Purple' => 'Purple',
            ],
            'placeholder' => 'Select color',
            'attr' => ['class' => 'border rounded p-2 w-full'],
        ])
        ->add('clarity', ChoiceType::class, [
            'choices' => [
                'IF' => 'IF',
                'VVS1' => 'VVS1',
                'VVS2' => 'VVS2',
                'VS1' => 'VS1',
            ],
            'placeholder' => 'Select clarity',
            'attr' => ['class' => 'border rounded p-2 w-full'],
        ])
        ->add('origin', ChoiceType::class, [
            'choices' => [
                'Brazil' => 'Brazil',
                'India' => 'India',
                'Sri Lanka' => 'Sri Lanka',
                'Madagascar' => 'Madagascar',
            ],
            'placeholder' => 'Select origin',
            'attr' => ['class' => 'border rounded p-2 w-full'],
        ])
        ->add('description', TextType::class, [
        'required' => false,
        'attr' => ['class' => 'border rounded p-2 w-full'],
        ])
       ->add('stock', NumberType::class, [
    'attr' => ['class' => 'border rounded p-2 w-full'],
        ])

        ->add('price', MoneyType::class, [
            'currency' => 'USD',
            'attr' => ['class' => 'border rounded p-2 w-full'],
        ])
            
        ->add('imagepath', FileType::class, [
            'label' => 'Upload Image',
            'mapped' => false,
            'required' => false,
            'attr' => ['class' => 'border rounded p-2 w-full'],
            'constraints' => [
                new File([
                    'maxSize' => '2M',
                    'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                    'mimeTypesMessage' => 'Please upload a valid image (JPEG, PNG, or WEBP)',
                ])
            ],
        ])


;
}
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ])
    
        ;
    }
    
}

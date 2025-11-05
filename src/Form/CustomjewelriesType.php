<?php

namespace App\Form;

use App\Entity\Customjewelries;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomjewelriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gemtype', TextType::class)
            ->add('jewelrytype', TextType::class)
            ->add('notes', TextareaType::class)
            ->add('imagepath', FileType::class, [
                'label' => 'Upload Image',
                'mapped' => false,
                'required' => false,
            ]);

        // ❌ REMOVE this line if you had it before:
        // ->add('created_at', null, [ 'widget' => 'single_text' ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customjewelries::class,
        ]);
    }
}

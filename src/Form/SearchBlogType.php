<?php 

// src/Form/SearchBlogType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchBlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('query', TextType::class, [
                'label' => 'Search term',
                'required' => false,
                'attr' => ['placeholder' => 'Search by title or content']
            ])
            ->add('dateFrom', DateType::class, [
                'label' => 'From date',
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('dateTo', DateType::class, [
                'label' => 'To date',
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('isFeatured', ChoiceType::class, [
                'label' => 'Featured status',
                'required' => false,
                'choices' => [
                    'All posts' => null,
                    'Featured only' => true,
                    'Non-featured only' => false,
                ],
            ])
            ->add('search', SubmitType::class, [
                'label' => 'Search',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }
}
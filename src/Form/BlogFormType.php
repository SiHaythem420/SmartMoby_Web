<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Form\Type\VichFileType;

class BlogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Title cannot be empty']),
                    new Assert\Length([
                        'min' => 5,
                        'minMessage' => 'Title must be at least {{ limit }} characters long',
                    ])
                ]
            ])
            ->add('content', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Content cannot be empty']),
                    new Assert\Length([
                        'min' => 20,
                        'minMessage' => 'Content must be at least {{ limit }} characters long',
                    ])
                ]
            ])
            ->add('date') // You can remove this if you set the date automatically
            ->add('imageFile', VichFileType::class, [
                'label' => 'Blog Image',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'delete_label' => 'Remove image',
                'download_label' => 'Download image',
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Please upload a valid JPG or PNG image',
                    ])
                ]
            ])
            ->add('isFeatured', CheckboxType::class, [
                'label' => 'Feature this post?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}

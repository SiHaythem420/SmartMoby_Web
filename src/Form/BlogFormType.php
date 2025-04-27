<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichFileType;


class BlogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('date')
            ->add('imageFile', VichFileType::class, [
                'label' => 'Blog Image',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'delete_label' => 'Remove image',
                'download_label' => 'Download image',
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

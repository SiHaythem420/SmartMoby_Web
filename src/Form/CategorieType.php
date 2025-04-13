<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom de l\'événement',
            'attr' => [
                'placeholder' => 'Entrez le nom de la categorie',
                'class' => 'form-control'
            ]
        ])
        ->add('description', TextType::class, [
            'label' => 'Nom de l\'événement',
            'attr' => [
                'placeholder' => 'Entrez la description de la categorie',
                'class' => 'form-control'
            ]
        ])        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}

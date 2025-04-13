<?php

namespace App\Form;

use App\Entity\Organisateur;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class OrganisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num_badge', IntegerType::class, [
                'label' => 'Numéro de badge',
                'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Le Numéro de badge est obligatoire pour un organisateur.']),
                    new Regex([
                        'pattern' => '/^\d{8}$/',
                        'message' => 'Le Numéro de badge doit être un numéro de 8 chiffres.',
                    ]),
                ],
                'empty_data' => '',
            
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Organisateur::class,
        ]);
    }
}

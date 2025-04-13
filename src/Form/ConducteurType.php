<?php

namespace App\Form;

use App\Entity\Conducteur;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ConducteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero_permis', IntegerType::class, [
                'label' => 'Numéro de Permis',
                'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Le Numéro de Permis est obligatoire pour un Conducteur.']),
                    new Regex([
                        'pattern' => '/^\d{8}$/',
                        'message' => 'Le Numéro de Permis doit être un numéro de 8 chiffres.',
                    ]),
                ],
                'empty_data' => '',])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conducteur::class,
        ]);
    }
}

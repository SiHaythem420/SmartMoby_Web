<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MotDePasseOublie3Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('mot_de_passe', PasswordType::class, [
            'label' => 'Mot de Passe',
            'required' => false,
            'empty_data' => '',
        ])
        ->add('nom', TextType::class, [
            'label' => 'Nom',
            'required' => false,
            'disabled' => true,
        ])
        ->add('prenom', TextType::class, [
            'label' => 'Prénom',
            'required' => false,
            'disabled' => true,
        ])
        ->add('nom_utilisateur', TextType::class, [
            'label' => "Nom d'utilisateur",
            'required' => false,
            'disabled' => true,
        ])
        ->add('email', TextType::class, [
            'label' => 'Email',
            'required' => false,
            'disabled' => true,
        ])
        ->add('role', ChoiceType::class, [
            'label' => 'Rôle',
            'choices' => [
                'Client' => 'client',
                'Admin' => 'admin',
                'Conducteur' => 'conducteur',
                'Organisateur' => 'organisateur',
            ],
            'placeholder' => 'Sélectionnez un rôle', 
            'required' => false,
            'disabled' => true,
        ]);
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}

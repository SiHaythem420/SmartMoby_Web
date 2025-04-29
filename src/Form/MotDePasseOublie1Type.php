<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class MotDePasseOublie1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', TextType::class, [
            'label' => 'Email',
            'required' => false,
        ])
        ->add('nom', TextType::class, [
            'required' => false,
            'disabled' => true,
            'constraints' => []  // Aucune contrainte pour 'Nom'
        ])
        ->add('prenom', TextType::class, [
            'required' => false,
            'disabled' => true,
            'constraints' => []  // Aucune contrainte pour 'Prénom'

        ])
        ->add('nom_utilisateur', TextType::class, [
            'required' => false,
            'disabled' => true,
            'constraints' => []  // Aucune contrainte pour 'Nom d'utilisateur'
        ])
        ->add('mot_de_passe', PasswordType::class, [
            'required' => false,
            'disabled' => true,
            'constraints' => []  // Aucune contrainte pour 'Mot de passe'
        ])
        ->add('role', TextType::class, [
            'required' => false,
            'disabled' => true,
            'constraints' => []  // Aucune contrainte pour 'Rôle'
        ])
        
        
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}

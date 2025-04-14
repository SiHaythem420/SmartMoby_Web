<?php

namespace App\Form;

use App\Entity\Evenment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EvenmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => false,
                'attr' => ['placeholder' => 'Nom', 'class' => 'form-control']
                
            ])
            ->add('date', null, [
                'label' => 'Date',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu',
                'required' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenment::class,
        ]);
    }
}

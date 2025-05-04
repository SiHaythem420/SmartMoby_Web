<?php
namespace App\Form;

use App\Entity\Produit;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Nom du produit'])
            ->add('type', TextType::class, ['label' => 'Type'])
            ->add('prix', IntegerType::class, ['label' => 'Prix'])
            ->add('services', EntityType::class, [  // liaison ManyToMany
                'class'        => Service::class,
                'choice_label' => 'nom',
                'multiple'     => true,
                'expanded'     => false,
                'label'        => 'Services associés',
                'required'     => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
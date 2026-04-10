<?php

namespace App\Form;

use App\Entity\Intervention;
use App\Entity\Projet;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('compteRendu')
            ->add('dateIntervention')
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Planifiée'   => 'planifiee',
                    'En cours'    => 'en_cours',
                    'Terminée'    => 'terminee',
                    'Annulée'     => 'annulee',
                    'En attente'  => 'en_attente',
                ],
                'placeholder' => 'Sélectionner un statut',
            ])
            ->add('projet', EntityType::class, [
                'class' => Projet::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}

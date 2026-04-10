<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('typeProjet', ChoiceType::class, [
                'label'       => 'Type de projet',
                'placeholder' => '— Sélectionner —',
                'required'    => false,
                'choices'     => [
                    'Construction neuve'     => 'Construction neuve',
                    'Rénovation'             => 'Rénovation',
                    'Extension'              => 'Extension',
                    'Réhabilitation'         => 'Réhabilitation',
                    'Aménagement intérieur'  => 'Aménagement intérieur',
                    'Urbanisme'              => 'Urbanisme',
                    'Expertise / Diagnostic' => 'Expertise / Diagnostic',
                    'Autre'                  => 'Autre',
                ],
            ])
            ->add('statut', ChoiceType::class, [
                'label'   => 'Statut',
                'choices' => [
                    'En attente' => 'en_attente',
                    'En cours'   => 'en_cours',
                    'Terminé'    => 'termine',
                    'Annulé'     => 'annule',
                ],
            ])
            ->add('dateDebut', DateType::class, [
                'label'    => 'Date de début',
                'widget'   => 'single_text',
                'required' => false,
            ])
            ->add('dateFinPrevue', DateType::class, [
                'label'    => 'Date de fin prévue',
                'widget'   => 'single_text',
                'required' => false,
            ])
            ->add('budget', MoneyType::class, [
                'label'    => 'Budget',
                'currency' => 'EUR',
                'required' => false,
            ])
            ->add('adresseChantier', TextType::class, [
                'label'    => 'Adresse chantier',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label'    => 'Description',
                'required' => false,
            ])
            ->add('architecte', EntityType::class, [
                'label'        => 'Architecte',
                'class'        => User::class,
                'choice_label' => function (User $user) {
                    return $user->getPrenom() . ' ' . $user->getNom();
                },
                'placeholder'  => '— Sélectionner un architecte —',
                'required'     => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
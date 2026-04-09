<?php

namespace App\Form;

use App\Entity\DemandeClient;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class DemandeClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('objet')
        ->add('description')
        ->add('typePrestation', ChoiceType::class, [
            'choices'  => [
                'Installation' => 'Installation',
                'Maintenance' => 'Maintenance',
                'Dépannage' => 'Dépannage',
                'Audit' => 'Audit',
            ],
        ])
        ->add('creneauSouhaite', DateTimeType::class, [
            'widget' => 'single_text',
            'required' => true,
        ])
        ->add('statut', ChoiceType::class, [
            'choices'  => [
                'En attente' => 'non_accepte',
                'Accepté' => 'accepte',
            ],
        ])
        ->add('architecte', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'email',
            'placeholder' => 'Choisir un architecte...',
            'required' => false,
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeClient::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',         TextType::class,     ['label' => 'Nom'])
            ->add('prenom',      TextType::class,     ['label' => 'Prénom'])
            ->add('email',       EmailType::class,    ['label' => 'Email'])
            ->add('telephone',   TelType::class,      ['label' => 'Téléphone',     'required' => false])
            ->add('numeroOrdre', TextType::class,     ['label' => "Numéro d'ordre",'required' => false])
            ->add('specialites', TextType::class,     ['label' => 'Spécialités',   'required' => false])
            ->add('horaires',    TextareaType::class, ['label' => 'Horaires',      'required' => false])
            ->add('description', TextareaType::class, ['label' => 'Description',   'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

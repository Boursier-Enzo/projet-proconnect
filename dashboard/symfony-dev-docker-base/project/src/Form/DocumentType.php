<?php

namespace App\Form;

use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('typeDocument', ChoiceType::class, [
                'label'       => 'Type de document',
                'placeholder' => '— Sélectionner —',
                'required'    => false,
                'choices'     => [
                    'Permis de construire'  => 'Permis de construire',
                    'Plan architectural'    => 'Plan architectural',
                    'Devis'                 => 'Devis',
                    'Facture'               => 'Facture',
                    'Contrat'               => 'Contrat',
                    "Rapport d'expertise"   => "Rapport d'expertise",
                    'Notice descriptive'    => 'Notice descriptive',
                    'Certificat'            => 'Certificat',
                    'Autre'                 => 'Autre',
                ],
            ])
            ->add('fichierPath', TextType::class, [
                'label'    => 'Chemin du fichier',
                'required' => false,
            ])
            ->add('codeAcces', TextType::class, [
                'label'    => "Code d'accès",
                'required' => false,
            ])
            ->add('contenu', TextareaType::class, [
                'label'    => 'Contenu / Notes',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
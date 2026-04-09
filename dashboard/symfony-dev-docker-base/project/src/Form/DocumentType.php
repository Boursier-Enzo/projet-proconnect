<?php

namespace App\Form;

use App\Entity\DemandeClient;
use App\Entity\Document;
use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options,
    ): void {
        $builder
            ->add("titre")
            ->add("typeDocument")
            ->add("fichierPath")
            ->add("codeAcces")
            ->add("contenu")
            ->add("createdAt", null, [
                "widget" => "single_text",
            ])
            ->add("updatedAt", null, [
                "widget" => "single_text",
            ])
            ->add("projet", EntityType::class, [
                "class" => Projet::class,
                "choice_label" => "id",
            ])
            ->add("demande", EntityType::class, [
                "class" => DemandeClient::class,
                "choice_label" => "id",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => Document::class,
        ]);
    }
}

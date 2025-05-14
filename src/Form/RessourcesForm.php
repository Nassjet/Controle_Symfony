<?php

namespace App\Form;

use App\Entity\Ressources;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourcesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('presentation')
            ->add('Support')
            ->add('Nature')
            ->add('url')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressources::class,
        ]);
    }
}

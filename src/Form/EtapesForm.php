<?php

namespace App\Form;

use App\Entity\Etapes;
use App\Entity\Parcours;
use App\Entity\RendusActivites;
use App\Entity\Ressources;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtapesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Descriptif')
            ->add('Consignes')
            ->add('Position')
            ->add('parcours', EntityType::class, [
                'class' => Parcours::class,
                'choice_label' => 'id',
            ])
            ->add('rendusActivites', EntityType::class, [
                'class' => RendusActivites::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('ressources', EntityType::class, [
                'class' => Ressources::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etapes::class,
        ]);
    }
}

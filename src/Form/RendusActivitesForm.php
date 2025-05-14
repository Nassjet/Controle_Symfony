<?php

namespace App\Form;

use App\Entity\Etapes;
use App\Entity\Messages;
use App\Entity\RendusActivites;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendusActivitesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url')
            ->add('dateHeure')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('messages', EntityType::class, [
                'class' => Messages::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('etapes', EntityType::class, [
                'class' => Etapes::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendusActivites::class,
        ]);
    }
}

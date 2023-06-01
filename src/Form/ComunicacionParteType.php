<?php

namespace App\Form;

use App\Entity\ComunicacionParte;
use App\Entity\Parte;
use App\Entity\TipoComunicacion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComunicacionParteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha')
            ->add('anotacion')
            ->add('parte', EntityType::class, [
                'label' => 'Parte a la que pertenece',
                'class' => Parte::class,
                'required' => true
            ])
            ->add('tipo', EntityType::class, [
                'label' => 'Tipo',
                'class' => TipoComunicacion::class,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ComunicacionParte::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\ComunicacionSancion;
use App\Entity\Sancion;
use App\Entity\TipoComunicacion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComunicacionSancionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha')
            ->add('anotacion')
            ->add('sancion', EntityType::class, [
                'label' => 'Sancion a la que pertenece',
                'class' => Sancion::class,
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
            'data_class' => ComunicacionSancion::class,
        ]);
    }
}

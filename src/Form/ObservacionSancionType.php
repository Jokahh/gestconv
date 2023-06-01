<?php

namespace App\Form;

use App\Entity\ObservacionSancion;
use App\Entity\Sancion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservacionSancionType extends AbstractType
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ObservacionSancion::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Estudiante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstudianteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nie')
            ->add('nombre')
            ->add('apellido1')
            ->add('apellido2')
            ->add('telefono1')
            ->add('telefono2')
            ->add('notaTelefono1')
            ->add('notaTelefono2')
            ->add('tutor1')
            ->add('tutor2')
            ->add('fechaNacimiento')
            ->add('direccion')
            ->add('observaciones')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Estudiante::class,
        ]);
    }
}

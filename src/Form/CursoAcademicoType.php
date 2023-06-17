<?php

namespace App\Form;

use App\Entity\CursoAcademico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CursoAcademicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción',
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ])
            ->add('fechaInicio', DateType::class, [
                'label' => 'Fecha de Inicio',
                'required' => true,
                'format' => 'yyyy-MM-dd',
                'widget' => 'single_text',
                'help' => 'Fecha de inicio del curso académico'
            ])
            ->add('fechaFin', DateType::class, [
                'label' => 'Fecha de Fin',
                'required' => true,
                'format' => 'yyyy-MM-dd',
                'widget' => 'single_text',
                'help' => 'Fecha de fin del curso académico',
            ])
            ->add('estado', CheckboxType::class, [
                'label' => 'Inactivo / Activo',
                'label_attr' => ['class' => 'switch-custom'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CursoAcademico::class,
        ]);
    }
}

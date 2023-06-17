<?php

namespace App\Form;

use App\Entity\ActitudFamilia;
use App\Entity\CursoAcademico;
use App\Entity\Tramo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Activo', 'data-off' => '<i class="fa fa-xmark"></i> Inactivo'],
            ])
            ->add('tramos', EntityType::class, [
                'label' => 'Tramos',
                'class' => Tramo::class,
                'required' => true,
                'multiple' => true,
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona los tramos', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ])
            ->add('actitudesFamilia', EntityType::class, [
                'label' => 'Actitudes de Familia',
                'class' => ActitudFamilia::class,
                'required' => true,
                'multiple' => true,
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona las actitudes de familia', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CursoAcademico::class,
        ]);
    }
}

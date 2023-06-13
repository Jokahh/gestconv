<?php

namespace App\Form;

use App\Entity\ActitudFamilia;
use App\Entity\CursoAcademico;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ActitudFamiliaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orden', NumberType::class, [
                'label' => 'Orden',
                'required' => true
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ])
            ->add('fecha', DateTimeType::class, [
                'label' => 'Fecha',
                'date_label' => 'Fecha',
                'date_widget' => 'single_text',
                'time_label' => 'Hora',
                'time_widget' => 'single_text'
            ])
            ->add('cursoAcademico', EntityType::class, [
                'label' => 'Curso académico',
                'class' => CursoAcademico::class,
                'required' => true,
                'help' => 'Seleccione el curso académico en el que se va a asignar',
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona un curso académico', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ActitudFamilia::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\ActitudFamilia;
use App\Entity\Medida;
use App\Entity\Parte;
use App\Entity\Sancion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class SancionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fechaSancion', DateTimeType::class, [
                'label' => 'Fecha de la sanción',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('fechaInicioSancion', DateTimeType::class, [
                'label' => 'Fecha inicio',
                'help' => 'Fecha del inicio de la sanción',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('fechaFinSancion', DateTimeType::class, [
                'label' => 'Fecha fin',
                'help' => 'Fecha del fin de la sanción',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('fechaRegistroSalida', DateTimeType::class, [
                'label' => 'Fecha registro salida',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('fechaComunicado', DateTimeType::class, [
                'label' => 'Fecha de comunicado',
                'help' => 'Fecha del comunicado de la sanción',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('anotacion', TextareaType::class, [
                'label' => 'Anotación',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ])
            ->add('motivosNoAplicacion', TextareaType::class, [
                'label' => 'Motivos de no aplicación',
                'help' => 'Motivos por los que no se ha aplicado esta sanción',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ])
            ->add('actitudFamilia', EntityType::class, [
                'label' => 'Actitud de la familia',
                'help' => 'Selecciona la actitud de la familia en respecto a esta sanción',
                'class' => ActitudFamilia::class,
                'required' => true,
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona una actitud de familia', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ])
            ->add('medidas', EntityType::class, [
                'label' => 'Medidas',
                'help' => 'Selecciona las medidas que se aplican a esta sanción',
                'class' => Medida::class,
                'required' => true,
                'multiple' => true,
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona las medidas', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ])
            ->add('partes', EntityType::class, [
                'label' => 'Partes',
                'help' => 'Selecciona los partes a los que está asignado esta sanción',
                'class' => Parte::class,
                'required' => true,
                'multiple' => true,
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona los partes', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ])
            ->add('reclamacion', CheckboxType::class, [
                'label' => 'Hay reclamación?',
                'required' => false,
                'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
            ])
            ->add('registradoEnSeneca', CheckboxType::class, [
                'label' => 'Está registrada en Séneca?',
                'required' => false,
                'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
            ])
            ->add('medidasEfectivas', CheckboxType::class, [
                'label' => 'Las medidas fueron efectivas?',
                'required' => false,
                'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sancion::class,
        ]);
    }
}

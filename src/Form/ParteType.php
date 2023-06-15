<?php

namespace App\Form;

use App\Entity\ConductaContraria;
use App\Entity\Docente;
use App\Entity\Estudiante;
use App\Entity\Parte;
use App\Entity\Sancion;
use App\Entity\Tramo;
use App\Repository\TramoRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ParteType extends AbstractType
{
    private $tramoRepository;

    public function __construct(TramoRepository $tramoRepository)
    {
        $this->tramoRepository = $tramoRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $tramos = $this->tramoRepository->findAllByCursoActivo();
        $builder
            ->add('docente', EntityType::class, [
                'label' => 'Docente u ordenanza',
                'class' => Docente::class,
                'required' => true,
                'help' => 'Seleccione el docente u ordenanza que asigna el parte',
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona un docente', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ])
            ->add('estudiante', EntityType::class, [
                'label' => 'Estudiante',
                'class' => Estudiante::class,
                'required' => true,
                'help' => 'Selecciona uno o varios estudiantes a los que se les asignará este parte',
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona uno varios estudiantes', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Ninguno seleccionado', 'data-size' => '7']
            ])
            ->add('anotacion', TextareaType::class, [
                'label' => 'Anotación',
                'required' => true,
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ],
            ])
            ->add('fechaCreacion', DateTimeType::class, [
                'label' => 'Fecha de creación',
                'date_label' => 'Fecha de creación',
                'date_widget' => 'single_text',
                'time_label' => 'Hora',
                'time_widget' => 'single_text',
                'attr' => ['readonly' => true]
            ])
            ->add('fechaSuceso', DateTimeType::class, [
                'label' => 'Fecha de suceso',
                'date_label' => 'Fecha de suceso',
                'required' => true,
                'help' => 'Fecha y hora cuando ocurrió el suceso',
                'date_widget' => 'single_text',
                'time_label' => 'Hora',
                'time_widget' => 'single_text'
            ]);
        if ($options['nuevo'] === false) {
            $builder
                ->add('fechaAviso', DateTimeType::class, [
                    'label' => 'Fecha de aviso',
                    'date_label' => 'Fecha de aviso',
                    'required' => false,
                    'date_widget' => 'single_text',
                    'time_label' => 'Hora',
                    'time_widget' => 'single_text'
                ])
                ->add('fechaRecordatorio', DateTimeType::class, [
                    'label' => 'Fecha de recordatorio',
                    'date_label' => 'Fecha de recordatorio',
                    'date_widget' => 'single_text',
                    'required' => false,
                    'time_label' => 'Hora',
                    'time_widget' => 'single_text'
                ]);
        }
        $builder
            ->add('hayExpulsion', CheckboxType::class, [
                'label' => 'Hay expulsión?',
                'required' => false,
                'help' => 'Marcar si se expulsó el alumnado implicado del aula',
                'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
            ])
            ->add('actividades', TextareaType::class, [
                'label' => 'Actividades a realizar',
                'required' => false,
                'help' => 'Actividades que debe realizar el alumno si se ha expulsado',
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ],
            ])
            ->add('actividadesRealizadas', ChoiceType::class, [
                'label' => 'Se han realizado las actividades?',
                'choices' => [
                    'No se sabe' => 'No se sabe',
                    'Si' => 'Si',
                    'No' => 'No'
                ],
            ])
            ->add('tramo', ChoiceType::class, [
                'label' => 'Tramo',
                'choices' => $tramos,
                'choice_label' => function (?Tramo $tramo) {
                    return $tramo;
                },
                'required' => true,
                'help' => 'Seleccione el tramo cuando ocurrió el suceso',
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona un tramo', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ]);
        if ($options['nuevo'] === false) {
            $builder
                ->add('sancion', EntityType::class, [
                    'label' => 'Sanción',
                    'class' => Sancion::class,
                    'required' => false,
                    'help' => 'Seleccione la sanción',
                    'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona una sanción', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
                ]);
        }
        $builder
            ->add('conductasContrarias', EntityType::class, [
                'label' => 'Conductas contrarias',
                'class' => ConductaContraria::class,
                'help' => 'Conductas contrarias que provocan el parte',
                'required' => true,
                'multiple' => true,
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona las conductas contrarias', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ])
            ->add('prioritaria', CheckboxType::class, [
                'label' => 'Es prioritario?',
                'help' => 'Marcar si el parte es prioritario',
                'required' => false,
                'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
            ]);
        if ($options['admin'] === true) {
            $builder
                ->add('prescrito', CheckboxType::class, [
                    'label' => 'Ha prescrito?',
                    'help' => 'Marcar si el parte ha prescrito',
                    'required' => false,
                    'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
                ]);
        }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parte::class,
            'nuevo' => false,
            'admin' => false
        ]);
    }
}

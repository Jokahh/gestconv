<?php

namespace App\Form;

use App\Entity\CursoAcademico;
use App\Entity\Tramo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class TramoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orden', ChoiceType::class, [
                'label' => 'Orden',
                'choices' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ]
            ])
            ->add('diaSemana', ChoiceType::class, [
                'label' => 'Día de la semana',
                'choices' => [
                    'Lunes' => 'Lunes',
                    'Martes' => 'Martes',
                    'Miércoles' => 'Miércoles',
                    'Jueves' => 'Jueves',
                    'Viernes' => 'Viernes',
                    'Sábado' => 'Sábado',
                    'Domingo' => 'Domingo'
                ],
                'required' => false
            ])
            ->add('horaInicio', TextType::class, [
                'label' => 'Hora inicio',
                'help' => 'Hora de inicio del tramo (Formato h:m)',
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/',
                        'message' => 'La hora no es válida. Formato 24h (ej. 09:30)'
                    ])
                ]
            ])
            ->add('horaFin', TextType::class, [
                'label' => 'Hora fin',
                'help' => 'Hora de fin del tramo (Formato h:m)',
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/',
                        'message' => 'La hora no es válida. Formato 24h (ej. 15:30)'
                    ])
                ]
            ])
            ->add('aula', TextType::class, [
                'label' => 'Aula',
                'required' => false
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
            'data_class' => Tramo::class,
        ]);
    }
}

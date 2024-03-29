<?php

namespace App\Form;

use App\Entity\CursoAcademico;
use App\Entity\Docente;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class DocenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'required' => true,
                'constraints' => [
                    new NotNull([
                        'message' => 'Este campo no se puede dejar vacío'
                    ]),
                    new NotBlank([
                        'message' => 'Este campo no se puede dejar en blanco'
                    ]),
                    new Length([
                        'min' => 3,
                        'max' => 100,
                        'minMessage' => 'El tamaño mínimo de este campo es de 3 caracteres',
                        'maxMessage' => 'El tamaño máximo de este campo es de 100 caracteres'
                    ])
                ],
            ])
            ->add('apellido1', TextType::class, [
                'label' => 'Primer Apellido',
                'required' => true,
                'constraints' => [
                    new NotNull([
                        'message' => 'Este campo no se puede dejar vacío'
                    ]),
                    new NotBlank([
                        'message' => 'Este campo no se puede dejar en blanco'
                    ]),
                    new Length([
                        'min' => 3,
                        'max' => 100,
                        'minMessage' => 'El tamaño mínimo de este campo es de 3 caracteres',
                        'maxMessage' => 'El tamaño máximo de este campo es de 100 caracteres'
                    ])
                ],
            ])
            ->add('apellido2', TextType::class, [
                'label' => 'Segundo Apellido',
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 100,
                        'minMessage' => 'El tamaño mínimo de este campo es de 3 caracteres',
                        'maxMessage' => 'El tamaño máximo de este campo es de 100 caracteres'
                    ])
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'El tamaño mínimo de este campo es de 3 caracteres',
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ])
            ->add('telefono', TextType::class, [
                'label' => 'Teléfono',
                'help' => 'Número de teléfono',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 15,
                        'maxMessage' => 'El tamaño máximo de este campo es de 15 caracteres'
                    ])
                ]
            ])
            ->add('usuario', TextType::class, [
                'label' => 'Usuario',
                'required' => true,
                'help' => 'Nombre de usuario',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 100,
                        'minMessage' => 'El tamaño mínimo de este campo es de 5 caracteres',
                        'maxMessage' => 'El tamaño máximo de este campo es de 100 caracteres'
                    ])
                ]
            ])
            ->add('notificaciones', CheckboxType::class, [
                'label' => 'Recibir notificaciones por correo electrónico?',
                'required' => false,
                'label_attr' => ['class' => 'switch-custom'],
            ]);
        if ($options['admin'] === true) {
            $builder
                ->add('cursosAcademicos', EntityType::class, [
                    'label' => 'Cursos Académicos',
                    'class' => CursoAcademico::class,
                    'help' => 'Cursos académicos a los que está asignado',
                    'required' => true,
                    'multiple' => true,
                    'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona los cursos', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
                ])
                ->add('roles', ChoiceType::class, [
                    'label' => 'Roles',
                    'choices' => [
                        'Admin' => 'ROLE_ADMIN',
                        'Convivencia' => 'ROLE_CONVIVENCIA',
                        'Directivo' => 'ROLE_DIRECTIVO',
                        'Docente' => 'ROLE_DOCENTE',
                        'Tutor' => 'ROLE_TUTOR'
                    ],
                    'required' => false,
                    'multiple' => true,
                    'disabled' => true,
                    'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona las medidas', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
                ])
                ->add('esAdmin', CheckboxType::class, [
                    'label' => 'Es admin?',
                    'required' => false,
                    'disabled' => ($options['admin'] && $options['datosPropios']),
                    'label_attr' => ['class' => 'switch-custom'],
                ])
                ->add('esDirectivo', CheckboxType::class, [
                    'label' => 'Es directivo?',
                    'required' => false,
                    'label_attr' => ['class' => 'switch-custom'],
                ])
                ->add('esComisionario', CheckboxType::class, [
                    'label' => 'Es comisionario?',
                    'required' => false,
                    'label_attr' => ['class' => 'switch-custom'],
                ])
                ->add('estaActivo', CheckboxType::class, [
                    'label' => 'Está activo?',
                    'required' => false,
                    'label_attr' => ['class' => 'switch-custom'],
                ])
                ->add('esExterno', CheckboxType::class, [
                    'label' => 'Es externo?',
                    'required' => false,
                    'label_attr' => ['class' => 'switch-custom'],
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Docente::class,
            'admin' => false,
            'datosPropios' => false
        ]);
    }
}

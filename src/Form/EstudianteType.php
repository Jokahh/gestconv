<?php

namespace App\Form;

use App\Entity\Estudiante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;

class EstudianteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nie', TextType::class, [
                'label' => 'NIE',
                'required' => true,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[0-9]{8}[A-Z]$|^[XYZ][0-9]{7,8}[A-Z]$/',
                        'message' => 'El NIE no es válido'
                    ])
                ]
            ])
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
            ->add('fechaNacimiento', DateType::class, [
                'label' => 'Fecha de nacimiento',
                'required' => false,
                'format' => 'yyyy-MM-dd',
                'widget' => 'single_text'
            ])
            ->add('telefono1', TextType::class, [
                'label' => 'Número de teléfono 1',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 15,
                        'maxMessage' => 'El tamaño máximo de este campo es de 15 caracteres'
                    ])
                ]
            ])
            ->add('notaTelefono1', TextType::class, [
                'label' => 'Nota del primer número de teléfono 1',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ])
            ->add('telefono2', TextType::class, [
                'label' => 'Número de teléfono 2',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 15,
                        'maxMessage' => 'El tamaño máximo de este campo es de 15 caracteres'
                    ])
                ]
            ])
            ->add('notaTelefono2', TextType::class, [
                'label' => 'Nota del segundo número de teléfono',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ])
            ->add('tutor1', TextType::class, [
                'label' => 'Tutor',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 100,
                        'maxMessage' => 'El tamaño máximo de este campo es de 100 caracteres'
                    ])
                ]
            ])
            ->add('tutor1', TextType::class, [
                'label' => 'Segundo tutor',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 100,
                        'maxMessage' => 'El tamaño máximo de este campo es de 100 caracteres'
                    ])
                ]
            ])
            ->add('direccion', TextType::class, [
                'label' => 'Dirección',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 100,
                        'maxMessage' => 'El tamaño máximo de este campo es de 100 caracteres'
                    ])
                ]
            ])
            ->add('observaciones', TextareaType::class, [
                'label' => 'Observaciones',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Estudiante::class,
        ]);
    }
}

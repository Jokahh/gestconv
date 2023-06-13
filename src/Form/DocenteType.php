<?php

namespace App\Form;

use App\Entity\Docente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
                'label' => 'Número de teléfono',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 15,
                        'maxMessage' => 'El tamaño máximo de este campo es de 15 caracteres'
                    ])
                ]
            ])
            ->add('usuario');

        if ($options['admin'] === true) {
            $builder
                ->add('notificaciones', CheckboxType::class, [
                    'label' => 'Tiene notificaciones?',
                    'required' => false,
                    'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
                ])
                ->add('esAdmin', CheckboxType::class, [
                    'label' => 'Es admin?',
                    'required' => false,
                    'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
                ])
                ->add('estaActivo', CheckboxType::class, [
                    'label' => 'Está activo?',
                    'required' => false,
                    'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
                ])
                ->add('estaBloqueado', CheckboxType::class, [
                    'label' => 'Está bloqueado?',
                    'required' => false,
                    'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
                ])
                ->add('esExterno', CheckboxType::class, [
                    'label' => 'Es externo?',
                    'required' => false,
                    'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
                ])
                ->add('esDirectivo', CheckboxType::class, [
                    'label' => 'Es directivo?',
                    'required' => false,
                    'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
                ])
                ->add('esConvivencia', CheckboxType::class, [
                    'label' => 'Es convivencia?',
                    'required' => false,
                    'attr' => ['data-toggle' => 'toggle', 'data-onstyle' => 'primary', 'data-offstyle' => 'danger', 'data-on' => '<i class="fa fa-check"></i> Si', 'data-off' => '<i class="fa fa-xmark"></i> No'],
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Docente::class,
            'admin' => false
        ]);
    }
}

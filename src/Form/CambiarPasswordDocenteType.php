<?php

namespace App\Form;

use App\Entity\Docente;
use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class CambiarPasswordDocenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['admin'] === false) {
            $builder
                ->add('claveAntigua', PasswordType::class, [
                    'label' => 'Contraseña actual',
                    'required' => false,
                    'mapped' => false,
                    'constraints' => [
                        new UserPassword(),
                        new NotBlank()
                    ]
                ]);
        }
        $builder
            ->add('nuevaClave', RepeatedType::class, [
                'label' => 'Nueva contraseña',
                'required' => true,
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'No coinciden las contraseñas',
                'first_options' => [
                    'label' => 'Nueva contraseña',
                    'constraints' => [
                        new NotBlank([
                            'groups' => ['password']
                        ])
                    ]
                ],
                'second_options' => [
                    'label' => 'Repite nueva contraseña',
                    'required' => true
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Docente::class,
            'admin' => false
        ]);
    }
}

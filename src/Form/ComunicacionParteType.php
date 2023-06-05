<?php

namespace App\Form;

use App\Entity\ComunicacionParte;
use App\Entity\Parte;
use App\Entity\TipoComunicacion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ComunicacionParteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', DateTimeType::class, [
                'label' => 'Fecha',
                'required' => true,
                'help' => 'Ingrese la fecha',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy-MM-dd',
            ])
            ->add('anotacion', TextareaType::class, [
                'label' => 'Anotación',
                'required' => false,
                'help' => 'Ingrese una anotación',
            ])
            ->add('parte', EntityType::class, [
                'label' => 'Parte a la que pertenece',
                'class' => Parte::class,
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('tipo', EntityType::class, [
                'label' => 'Tipo',
                'class' => TipoComunicacion::class,
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ComunicacionParte::class,
        ]);
    }
}

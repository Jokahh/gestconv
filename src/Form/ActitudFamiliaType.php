<?php

namespace App\Form;

use App\Entity\ActitudFamilia;
use App\Entity\CursoAcademico;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class ActitudFamiliaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orden', TextType::class, [
                'label' => 'Orden',
                'constraints' => [
                    new NotNull()
                ],
                'help' => 'ASC / DESC'
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción',
                'help' => 'Ingrese una descripción de la tarea'
            ])
            ->add('fecha', DateTimeType::class, [
                'label' => 'Fecha',
                'required' => true,
                'help' => 'Ingrese la fecha (YYYY-MM-DD)',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('cursoAcademico', EntityType::class, [
                'label' => 'Curso académico a la que pertenece',
                'class' => CursoAcademico::class,
                'required' => true,
                'help' => 'Seleccione el curso académico'
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ActitudFamilia::class,
        ]);
    }
}

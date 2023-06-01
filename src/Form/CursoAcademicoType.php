<?php

namespace App\Form;

use App\Entity\ActitudFamilia;
use App\Entity\CursoAcademico;
use App\Entity\Tramo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CursoAcademicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descripcion')
            ->add('fechaInicio')
            ->add('fechaFin')
            ->add('estado')
            ->add('semestre')
            ->add('tramos', EntityType::class, [
                'label' => 'Tramos',
                'class' => Tramo::class,
                'required' => true,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('actitudesFamilia', EntityType::class, [
                'label' => 'Actitudes de Familia',
                'class' => ActitudFamilia::class,
                'required' => true,
                'multiple' => true,
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CursoAcademico::class,
        ]);
    }
}

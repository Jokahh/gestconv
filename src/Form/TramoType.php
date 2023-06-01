<?php

namespace App\Form;

use App\Entity\CursoAcademico;
use App\Entity\Tramo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TramoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orden')
            ->add('diaSemana')
            ->add('horaInicio')
            ->add('horaFin')
            ->add('aula')
            ->add('cursoAcademico', EntityType::class, [
                'label' => 'Curso académico al que pertenece',
                'class' => CursoAcademico::class,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tramo::class,
        ]);
    }
}

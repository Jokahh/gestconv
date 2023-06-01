<?php

namespace App\Form;

use App\Entity\ActitudFamilia;
use App\Entity\CursoAcademico;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActitudFamiliaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orden')
            ->add('descripcion')
            ->add('fecha')
            ->add('cursoAcademico', EntityType::class, [
                'label' => 'Curso académico a la que pertenece',
                'class' => CursoAcademico::class,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ActitudFamilia::class,
        ]);
    }
}

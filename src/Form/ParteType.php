<?php

namespace App\Form;

use App\Entity\ConductasContrarias;
use App\Entity\Docente;
use App\Entity\Estudiante;
use App\Entity\Parte;
use App\Entity\Sancion;
use App\Entity\Tramo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fechaCreacion')
            ->add('fechaSuceso')
            ->add('fechaAviso')
            ->add('fechaRecordatorio')
            ->add('anotacion')
            ->add('prescrito')
            ->add('hayExpulsion')
            ->add('actividadesRealizadas')
            ->add('prioritaria')
            ->add('actividades')
            ->add('estudiante', EntityType::class, [
                'label' => 'Estudiante al que pertenece',
                'class' => Estudiante::class,
                'required' => true
            ])
            ->add('tramo', EntityType::class, [
                'label' => 'El tramo cuando ocurrió',
                'class' => Tramo::class,
                'required' => true
            ])
            ->add('docente', EntityType::class, [
                'label' => 'Docente que lo ha creado',
                'class' => Docente::class,
                'required' => true
            ])
            ->add('sancion', EntityType::class, [
                'label' => 'Sancion que se aplica',
                'class' => Sancion::class,
                'required' => false
            ])
            ->add('conductasContrarias', EntityType::class, [
                'label' => 'Conductas Contrarias',
                'class' => ConductasContrarias::class,
                'required' => true,
                'multiple' => true,
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parte::class,
        ]);
    }
}

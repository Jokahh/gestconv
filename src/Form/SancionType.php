<?php

namespace App\Form;

use App\Entity\ActitudFamilia;
use App\Entity\Medida;
use App\Entity\Parte;
use App\Entity\Sancion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SancionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fechaSancion')
            ->add('fechaRegistroSalida')
            ->add('fechaComunicado')
            ->add('fechaInicioSancion')
            ->add('fechaFinSancion')
            ->add('anotacion')
            ->add('reclamacion')
            ->add('registradoEnSeneca')
            ->add('motivosNoAplicacion')
            ->add('medidasEfectivas')
            ->add('actitudFamilia', EntityType::class, [
                'label' => 'Actitud Familia',
                'class' => ActitudFamilia::class,
                'required' => true
            ])
            ->add('medidas', EntityType::class, [
                'label' => 'Medidas',
                'class' => Medida::class,
                'required' => true,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('partes', EntityType::class, [
                'label' => 'Partes',
                'class' => Parte::class,
                'required' => true,
                'multiple' => true,
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sancion::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\CategoriaMedida;
use App\Entity\Medida;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class MedidaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orden', ChoiceType::class, [
                'label' => 'Orden',
                'required' => true,
                'choices' => range(0, 50)
            ])
            ->add('dias', IntegerType::class, [
                'label' => 'Días',
                'required' => false
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 100,
                        'maxMessage' => 'El tamaño máximo de este campo es de 100 caracteres'
                    ])
                ],
            ])
            ->add('categoria', EntityType::class, [
                'label' => 'Categoría',
                'class' => CategoriaMedida::class,
                'required' => true,
                'help' => 'Seleccione la categoría de la medida',
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona una categoría', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medida::class,
        ]);
    }
}

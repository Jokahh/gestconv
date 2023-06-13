<?php

namespace App\Form;

use App\Entity\CategoriaConductaContraria;
use App\Entity\ConductaContraria;
use App\Entity\Parte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConductaContrariaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orden', ChoiceType::class, [
                'label' => 'Orden',
                'required' => true,
                'choices' => range(0, 50)
            ])
            ->add('parte', EntityType::class, [
                'label' => 'Parte',
                'class' => Parte::class,
                'required' => true,
                'help' => 'Parte a la que pertenece',
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona un parte', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ])
            ->add('categoria', EntityType::class, [
                'label' => 'Categoría',
                'class' => CategoriaConductaContraria::class,
                'required' => true,
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona una categoría', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConductaContraria::class,
        ]);
    }
}

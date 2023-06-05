<?php

namespace App\Form;

use App\Entity\CategoriaConductaContraria;
use App\Entity\ConductaContraria;
use App\Entity\Parte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConductaContrariaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orden')
            ->add('parte', EntityType::class, [
                'label' => 'Parte',
                'class' => Parte::class,
                'required' => true
            ])
            ->add('categoria', EntityType::class, [
                'label' => 'Categoría',
                'class' => CategoriaConductaContraria::class,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConductaContraria::class,
        ]);
    }
}

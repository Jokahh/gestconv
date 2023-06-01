<?php

namespace App\Form;

use App\Entity\CategoriaMedida;
use App\Entity\Medida;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedidaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dias')
            ->add('nombre')
            ->add('orden')
            ->add('categoria', EntityType::class, [
                'label' => 'Categoría',
                'class' => CategoriaMedida::class,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medida::class,
        ]);
    }
}

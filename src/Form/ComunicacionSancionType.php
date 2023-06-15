<?php

namespace App\Form;

use App\Entity\ComunicacionSancion;
use App\Entity\Sancion;
use App\Repository\TipoComunicacionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ComunicacionSancionType extends AbstractType
{
    private $tipoComunicacionRepository;

    public function __construct(TipoComunicacionRepository $tipoComunicacionRepository)
    {
        $this->tipoComunicacionRepository = $tipoComunicacionRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $tiposComunicacion = $this->tipoComunicacionRepository->findAllByCursoActivo();
        $builder
            ->add('fecha', DateTimeType::class, [
                'label' => 'Fecha',
                'date_label' => 'Fecha',
                'date_widget' => 'single_text',
                'time_label' => 'Hora',
                'time_widget' => 'single_text'
            ])
            ->add('anotacion', TextareaType::class, [
                'label' => 'Anotación',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ])
            ->add('sancion', EntityType::class, [
                'label' => 'Sanción',
                'class' => Sancion::class,
                'required' => true,
                'help' => 'Sanción a la que pertenece',
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona una sanción', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ])
            ->add('tipo', ChoiceType::class, [
                'label' => 'Tipo',
                'choices' => $tiposComunicacion,
                'choice_label' => 'descripcion',
                'required' => true,
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona un tipo', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ComunicacionSancion::class,
        ]);
    }
}

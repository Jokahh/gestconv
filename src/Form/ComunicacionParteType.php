<?php

namespace App\Form;

use App\Entity\ComunicacionParte;
use App\Entity\Parte;
use App\Repository\ParteRepository;
use App\Repository\TipoComunicacionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ComunicacionParteType extends AbstractType
{
    private $tipoComunicacionRepository;
    private $parteRepository;

    public function __construct(TipoComunicacionRepository $tipoComunicacionRepository, ParteRepository $parteRepository)
    {
        $this->tipoComunicacionRepository = $tipoComunicacionRepository;
        $this->parteRepository = $parteRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $tiposComunicacion = $this->tipoComunicacionRepository->findAllByCursoActivo();
        if ($options['estudiante']) {
            $estudiante = $options['estudiante'];
            $partesDelEstudiante = $this->parteRepository->findNoNotificadosPorEstudiante($estudiante);
        }
        if ($options['estudiante']) {
            $builder
                ->add('parte', EntityType::class, [
                    'label' => 'Partes',
                    'choices' => $partesDelEstudiante,
                    'class' => Parte::class,
                    'required' => true,
                    'multiple' => true,
                    'expanded' => true,
                    'mapped' => false
                ]);
        }
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
            'data_class' => ComunicacionParte::class,
            'estudiante' => null
        ]);
    }
}

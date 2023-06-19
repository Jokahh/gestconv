<?php

namespace App\Form;

use App\Entity\Medida;
use App\Entity\Parte;
use App\Entity\Sancion;
use App\Repository\ActitudFamiliaRepository;
use App\Repository\ParteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class SancionType extends AbstractType
{
    private $actitudFamiliaRepository;
    private $parteRepository;

    public function __construct(ActitudFamiliaRepository $actitudFamiliaRepository, ParteRepository $parteRepository)
    {
        $this->actitudFamiliaRepository = $actitudFamiliaRepository;
        $this->parteRepository = $parteRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $actitudesFamilia = $this->actitudFamiliaRepository->findAllByCursoActivo();
        if ($options['estudiante']) {
            $estudiante = $options['estudiante'];
            $partesDelEstudiante = $this->parteRepository->findAllSancionablesPorEstudiante($estudiante);
        }
        if ($options['estudiante']) {
            $builder
                ->add('partes', EntityType::class, [
                    'label' => 'Partes',
                    'choices' => $partesDelEstudiante,
                    'class' => Parte::class,
                    'required' => true,
                    'multiple' => true,
                    'expanded' => true
                ]);
        }
        $builder
            ->add('medidas', EntityType::class, [
                'label' => 'Medidas',
                'help' => 'Medidas a adoptar para esta sanción',
                'class' => Medida::class,
                'required' => true,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('fechaSancion', DateTimeType::class, [
                'label' => 'Fecha de la sanción',
                'date_widget' => 'single_text',
                'time_label' => 'Hora',
                'time_widget' => 'single_text',
                'attr' => ['readonly' => true]
            ])
            ->add('fechaInicioSancion', DateTimeType::class, [
                'label' => 'Fecha inicio',
                'help' => 'Fecha del inicio de la sanción',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('fechaFinSancion', DateTimeType::class, [
                'label' => 'Fecha fin',
                'help' => 'Fecha del fin de la sanción',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ])
            ->add('fechaRegistroSalida', DateTimeType::class, [
                'label' => 'Fecha registro salida',
                'date_widget' => 'single_text',
                'required' => false,
                'time_widget' => 'single_text'
            ])
            ->add('fechaIncorporacion', DateTimeType::class, [
                'label' => 'Fecha de incorporación',
                'help' => 'Fecha del incorporación del alumno después de acabar la sanción si se ha expulsado',
                'date_widget' => 'single_text',
                'required' => false,
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
            ->add('motivosNoAplicacion', TextareaType::class, [
                'label' => 'Motivos de no aplicación',
                'help' => 'Motivos por los que no se ha aplicado esta sanción',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'El tamaño máximo de este campo es de 255 caracteres'
                    ])
                ]
            ])
            ->add('actitudFamilia', ChoiceType::class, [
                'label' => 'Actitud de la familia',
                'help' => 'Selecciona la actitud de la familia en respecto a esta sanción',
                'choices' => $actitudesFamilia,
                'choice_label' => 'descripcion',
                'required' => true,
                'attr' => ['class' => 'selectpicker show-tick', 'data-header' => 'Selecciona una actitud de familia', 'data-live-search' => 'true', 'data-live-search-placeholder' => 'Buscador..', 'data-none-selected-text' => 'Nada seleccionado', 'data-size' => '7']
            ])
            ->add('reclamacion', CheckboxType::class, [
                'label' => 'Hay reclamación?',
                'required' => false,
                'label_attr' => ['class' => 'switch-custom'],
            ])
            ->add('registradoEnSeneca', CheckboxType::class, [
                'label' => 'Está registrada en Séneca?',
                'required' => false,
                'label_attr' => ['class' => 'switch-custom'],
            ])
            ->add('medidasEfectivas', CheckboxType::class, [
                'label' => 'Las medidas fueron efectivas?',
                'required' => false,
                'label_attr' => ['class' => 'switch-custom'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sancion::class,
            'estudiante' => null,
            'sancion' => null
        ]);
    }
}

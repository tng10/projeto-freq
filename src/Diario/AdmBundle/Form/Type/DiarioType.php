<?php

namespace Diario\AdmBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class DiarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $anos = range(Date('Y'), Date('Y') + 4);
        $lista = array_combine($anos, array_values($anos));

        $builder
            ->add('disciplina', 'entity', array(
                'class' => 'Diario\AdmBundle\Entity\Disciplina',
                'constraints' =>  new NotBlank(),
                'required' => true
            ))
            ->add('professor', 'entity', array(
                'class' => 'Diario\AdmBundle\Entity\Professor',
                'constraints' =>  new NotBlank(),
                'required' => true
            ))
            ->add('codigoTurma','choice',array(
                'choices' => array(
                        '11' => 'Turma 11',
                        '12' => 'Turma 12',
                    ),
                'required' => true
            ))
            ->add('ano','choice', array(
                'choices' => $lista,
                'required' => true,
            ))  
            ->add('semestre','choice',array(
                'choices' => array(1 => 1, 2 => 2),
                'required' => true
            ))
            ->add('cargaHoraria','choice',array(
                'choices' => array(
                        '30' => '30 Horas',
                        '60' => '60 Horas',
                        '90' => '90 Horas',
                    ),
                'required' => true,
                'mapped' => false
            ))
            ->add('dia1','choice',array(
                'choices' => array(
                        'seg' => 'Segunda-feira',
                        'ter' => 'Terca-feira',
                        'qua' => 'Quarta-feira',
                        'qui' => 'Quinta-feira',
                        'sex' => 'Sexta-feira',
                        'sab' => 'Sabado',
                        'dom' => 'Domingo',
                    ),
                'required' => true,
                'mapped' => false
            ))
            ->add('dia2','choice',array(
                'choices' => array(
                        'seg' => 'Segunda-feira',
                        'ter' => 'Terca-feira',
                        'qua' => 'Quarta-feira',
                        'qui' => 'Quinta-feira',
                        'sex' => 'Sexta-feira',
                        'sab' => 'Sabado',
                        'dom' => 'Domingo',
                    ),
                'required' => false,
                'mapped' => false
            ))
            ->add('dia3','choice',array(
                'choices' => array(
                        'seg' => 'Segunda-feira',
                        'ter' => 'Terca-feira',
                        'qua' => 'Quarta-feira',
                        'qui' => 'Quinta-feira',
                        'sex' => 'Sexta-feira',
                        'sab' => 'Sabado',
                        'dom' => 'Domingo',
                    ),
                'required' => false,
                'mapped' => false
            ))
            ->add('dataInicio', 'date', array(
                'widget' => 'single_text',
                'datepicker' => true,
                'read_only' => true
            ))
            ->add('dataTermino', 'date', array(
                'widget' => 'single_text',
                'datepicker' => true,
                'read_only' => true
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'diario';
    }
}

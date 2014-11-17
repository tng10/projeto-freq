<?php

namespace Diario\ProfessorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListaDiaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aluno', 'entity', array(
                'class' => 'Diario\AdmBundle\Entity\Aluno',
                'property' => 'nome',
                'multiple' => true,
                'expanded' => true
              ))
            ->add('presenca','checkbox',array('mapped' => false))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            // 'data_class' => 'Diario\ImportarBundle\Entity\Diario',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'listadia';
    }
}

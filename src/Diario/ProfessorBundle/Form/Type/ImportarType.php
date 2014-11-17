<?php

namespace Diario\ProfessorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImportarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // var_dump($options['attr']['turma']);
        // exit;

        $builder
            ->add('arquivo','file',array('mapped' => false))
            ->add('turma','hidden',array('mapped' => false, 'data' => $options['attr']['turma']))
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
        return 'importar';
    }
}

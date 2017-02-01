<?php

namespace DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use DemoBundle\Entity\Temp;

class TempAdminType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created', 'datetime', array('label' => 'admin.entities.temp.fields.created'))
            ->add('modified', 'datetime', array('label' => 'admin.entities.temp.fields.modified'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Temp::class
        ));
    }
}

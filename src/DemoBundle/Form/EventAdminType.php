<?php

namespace DemoBundle\Form;

use Bazookas\AdminBundle\Form\Type\NestedFormType;
use DemoBundle\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventAdminType extends AbstractType
{

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('title', TextType::class, [
        'label' => 'admin.entities.event.fields.title',
      ])
      ->add('date',  DateTimeType::class, [
        'label' => 'admin.entities.event.fields.date',
        'required' => true,
        'datetimepicker' => true,
        'date_widget' => 'single_text',
        'time_widget' => 'single_text',
        'html5' => false,
        'model_timezone' => 'UTC',
        'view_timezone' => 'Europe/Brussels',
        'date_format' => 'dd/MM/yyyy',
        'attr' => array(
          'data-format' => 'dd/mm/yyyy',
        ),
      ])
      ->add('product', NestedFormType::class, [
        'label' => 'admin.entities.event.fields.product',
        'entry_type' => ProductAdminType::class,
        'prototype_name' => '__product__',
      ])
    ;
  }

  /**
   * @param OptionsResolver $resolver
   * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Event::class,
      'translation_domain' => 'admin',
    ]);
  }
}

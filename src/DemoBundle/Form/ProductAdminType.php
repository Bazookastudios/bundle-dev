<?php

namespace DemoBundle\Form;

use Bazookas\AdminBundle\Form\Type\TranslationFormType;
use DemoBundle\Entity\Product;
use DemoBundle\Entity\ProductDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductAdminType extends AbstractType
{

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('details', TranslationFormType::class, array(
        'label' => false,
        'entry_type' => ProductDetailAdminType::class,
        'entry_options' => array(
          'data_class' => ProductDetail::class
        ),
        'prototype_name' => '__product_detail__'
      ))
    ;
  }

  /**
   * @param OptionsResolver $resolver
   * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Product::class
    ]);
  }
}

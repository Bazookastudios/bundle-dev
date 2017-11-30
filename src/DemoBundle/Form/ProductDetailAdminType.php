<?php

namespace DemoBundle\Form;

use Bazookas\CommonBundle\Form\Type\LocaleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DemoBundle\Entity\ProductDetail;

class ProductDetailAdminType extends AbstractType
{

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('locale', LocaleType::class, [
        'label' => false
      ])
      ->add('title', TextType::class, [
        'label' => 'admin.entities.productDetail.fields.title'
      ])
    ;
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => ProductDetail::class
    ]);
  }
}

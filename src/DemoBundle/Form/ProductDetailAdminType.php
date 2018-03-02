<?php

namespace DemoBundle\Form;

use Bazookas\CommonBundle\Form\Type\LocaleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DemoBundle\Entity\ProductDetail;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductDetailAdminType extends AbstractType
{

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   * @throws \Symfony\Component\Validator\Exception\InvalidOptionsException
   * @throws \Symfony\Component\Validator\Exception\ConstraintDefinitionException
   * @throws \Symfony\Component\Validator\Exception\MissingOptionsException
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
      ->add('choiceField', ChoiceType::class, [
        'label' => 'admin.entities.productDetail.fields.choiceField',
        'choices' => [
          'yes' => 'yes',
          'no' => 'no'
        ]
      ])
      ->add('sendDateTime', DateTimeType::class, [
        'label' => 'admin.entities.productDetail.fields.sendDateTime',
        'datetimepicker' => true,
        'date_widget' => 'single_text',
        'time_widget' => 'single_text',
        'html5' => false,
        'model_timezone' => 'UTC',
        'view_timezone' => 'Europe/Brussels',
        'date_format' => 'dd/MM/yyyy',
        'constraints' => [
          new NotBlank(),
        ]
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
      'data_class' => ProductDetail::class
    ]);
  }
}

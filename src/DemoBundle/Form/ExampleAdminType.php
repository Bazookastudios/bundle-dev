<?php

namespace DemoBundle\Form;

use Bazookas\AdminBundle\Form\Type\EntityPickerType;
use Bazookas\AdminBundle\Form\Type\NestedFormType;
use Bazookas\MediaBundle\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExampleAdminType extends AbstractType
{
  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('published', null, array(
        'label' => 'admin.entities.example.fields.published')
      )
      ->add('title', null, array('label' => 'admin.entities.example.fields.title'))
//      ->add('singleImage', EntityPickerType::class, array(
//        'label' => 'admin.entities.example.fields.singleImage',
//        'class' => Image::class,
//        'display_field' => 'url',
//        'display_type' => 'image',
//        'picker_route' => array(
//          'route' => 'bazookas_media_image_admin',
//        ),
//      ))
//      ->add('multipleImages', NestedFormType::class, array(
//        'label' => 'admin.entities.example.fields.multipleImages',
//        'entry_type' => EntityPickerType::class,
//        'entry_options' => array(
//          'class' => Image::class,
//          'display_field' => 'url',
//          'display_type' => 'image',
//          'picker_route' => array(
//            'route' => 'bazookas_media_image_admin',
//          ),
//        )
//      ))
    ;
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
      'data_class' => 'DemoBundle\Entity\Example'
    ));
  }
}

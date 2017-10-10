<?php

namespace DemoBundle\Form;

use Bazookas\AdminBundle\Form\Extension\ToolTipExtension;
use Bazookas\AdminBundle\Form\Type\EntityPickerType;
use Bazookas\AdminBundle\Form\Type\NestedFormType;
use Bazookas\MediaBundle\Entity\Image;
use DemoBundle\Entity\Example;
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
      ->add('published', null, [
        'label' => 'admin.entities.example.fields.published',

        'tooltip_title' => 'admin.entities.example.tooltip.publishedTitle',
        'tooltip_content' => 'admin.entities.example.tooltip.publishedContent',
        'tooltip_type' => ToolTipExtension::TYPE_POP_OVER,
        'tooltip_placement' => ToolTipExtension::PLACEMENT_TOP,
      ])
      ->add('title', null, [
        'label' => 'admin.entities.example.fields.title',

        'tooltip_title' => 'admin.entities.example.tooltip.titleTitle',
        'tooltip_content' => 'admin.entities.example.tooltip.titleContent',
        'tooltip_type' => ToolTipExtension::TYPE_POP_OVER,
        'tooltip_trigger' => ToolTipExtension::TRIGGER_CLICK,
      ])
      ->add('singleImage', EntityPickerType::class, [
        'label' => 'admin.entities.example.fields.singleImage',
        'class' => Image::class,
        'display_field' => 'url',
        'display_type' => 'image',
        'picker_route' => [
          'route' => 'bazookas_media_image_admin',
        ],
      ])
      ->add('multipleImages', NestedFormType::class, [
        'label' => 'admin.entities.example.fields.multipleImages',
        'entry_type' => EntityPickerType::class,
        'entry_options' => [
          'class' => Image::class,
          'display_field' => 'url',
          'display_type' => 'image',
          'picker_route' => [
            'route' => 'bazookas_media_image_admin',
          ],
        ]
      ])
    ;
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
      'data_class' => Example::class,
      'translation_domain' => 'admin',
    ]);
  }
}

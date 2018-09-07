<?php

namespace DemoBundle\Form;

use Bazookas\AdminBundle\Form\Type\EntityPickerType;
use Bazookas\CommonBundle\Form\Type\LocaleType;
use Bazookas\MediaBundle\Entity\Image;
use Bazookas\MediaBundle\Entity\Video;
use DemoBundle\Entity\LinkedListEntityDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkedListEntityDetailAdminType extends AbstractType
{

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('locale', LocaleType::class, [
        'label' => false
      ])
      ->add('title', TextType::class, [
        'label' => 'admin.entities.linkedListEntityDetail.fields.title',
      ])
      ->add('description', TextareaType::class, [
        'label' => 'admin.entities.linkedListEntityDetail.fields.description',
      ])
      ->add('image', EntityPickerType::class, array(
        'label' => 'admin.entities.linkedListEntityDetail.fields.image',
        'class' => Image::class,
        'display_field' => 'relativeUrl',
        'display_type' => EntityPickerType::DISPLAY_ASSET,
        'picker_route' => array(
          'route' => 'bazookas_media_image_admin',
        ),
      ))
      ->add('video', EntityPickerType::class, [
        'label' => 'admin.entities.linkedListEntityDetail.fields.video',
        'class' => Video::class,
        'display_type' => EntityPickerType::DISPLAY_IMAGE,
        'display_field' => 'thumbnail',
        'picker_route' => [
          'route' => 'bazookas_media_video_admin',
        ],
      ])
    ;
  }

  /**
   * @param OptionsResolver $resolver
   * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
      'data_class' => LinkedListEntityDetail::class,
      'translation_domain' => 'admin',
    ]);
  }
}

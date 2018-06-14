<?php

namespace DemoBundle\Form;

use Bazookas\AdminBundle\Form\Type\HiddenEntityType;
use Bazookas\AdminBundle\Form\Type\TranslationFormType;
use DemoBundle\Entity\LinkedListEntity;
use DemoBundle\Entity\LinkedListEntityDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkedListEntityAdminType extends AbstractType
{

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('next', HiddenEntityType::class, [
        'label' => false,
        'class' => LinkedListEntity::class
      ])
      ->add('previous', HiddenEntityType::class, [
        'label' => false,
        'class' => LinkedListEntity::class
      ])
      ->add('details', TranslationFormType::class, array(
        'label' => false,
        'entry_type' => LinkedListEntityDetailAdminType::class,
        'entry_options' => array(
          'data_class' => LinkedListEntityDetail::class
        ),
        'prototype_name' => '__linked_list_entity_detail__',
        'require_all_locales' => true
      ));
  }

  /**
   * @param OptionsResolver $resolver
   * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
      'data_class' => LinkedListEntity::class,
      'translation_domain' => 'admin',
    ]);
  }
}

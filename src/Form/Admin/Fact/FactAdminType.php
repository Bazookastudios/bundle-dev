<?php

namespace App\Form\Admin\Fact;

use App\Entity\Fact\Fact;
use Bazookas\AdminBundle\Form\Type\TranslationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FactAdminType
 * @package App\Form\Admin\Fact
 */
class FactAdminType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('details', TranslationFormType::class, [
            'label' => false,
            'entry_type' => FactDetailAdminType::class,
            'require_all_locales' => true,
            'prototype_name' => '__fact_detail__',
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fact::class,
            'translation_domain' => 'admin',
        ]);
    }
}

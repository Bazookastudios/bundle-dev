<?php

namespace App\Form\Admin\Fact;

use App\Entity\Fact\FactDetail;
use Bazookas\AdminBundle\Form\Type\EntityPickerType;
use Bazookas\CommonBundle\Form\Type\LocaleType;
use Bazookas\MediaBundle\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FactDetailAdminType
 * @package App\Form\Admin\Fact
 */
class FactDetailAdminType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('locale', LocaleType::class, [
                'label' => false,
            ])
            ->add('fact', TextType::class, [
                'label' => 'admin.entities.factDetail.fields.fact',
                'attr' => [
                    'maxLength' => 255,
                ],
            ])
            ->add('image', EntityPickerType::class, [
                'label' => 'admin.entities.factDetail.fields.image',
                'class' => Image::class,
                'display_type' => EntityPickerType::DISPLAY_ASSET,
                'display_field' => 'thumbnail',
                'picker_route' => [
                    'route' => 'bazookas_media_image_admin',
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FactDetail::class,
            'translation_domain' => 'admin',
        ]);
    }
}

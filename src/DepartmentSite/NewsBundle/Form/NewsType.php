<?php

namespace DepartmentSite\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ITM\FilePreviewBundle\Form\Type\FilePreviewType;
use ITM\ImagePreviewBundle\Form\Type\ImagePreviewType;

class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('content')
            ->add('photo', ImagePreviewType::class, ['data_class' => null])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DepartmentSite\NewsBundle\Entity\News'
        ));
    }
}

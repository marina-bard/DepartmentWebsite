<?php

namespace DepartmentSite\ProjectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('student')
            ->add('teacher')
            ->add('course')
            ->add('studentGroup')
            ->add('startDate', 'date')
            ->add('endDate', 'date')
            ->add('description')
            ->add('content')
//            ->add('isModerated')
        ;
    }

}

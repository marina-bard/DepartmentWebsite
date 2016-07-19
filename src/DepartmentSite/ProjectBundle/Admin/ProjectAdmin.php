<?php

namespace DepartmentSite\ProjectBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use ITM\FilePreviewBundle\Form\Type\FilePreviewType;
use ITM\ImagePreviewBundle\Form\Type\ImagePreviewType;
use Symfony\Component\HttpFoundation\File\File;

class ProjectAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('student', 'text', array('label' => 'student'))
            ->add('teacher', 'text', array('label' => 'teacher'))
            ->add('reviewer', 'text', array('label' => 'reviewer'))
            ->add('course', 'number', array('label' => 'course'))
            ->add('studentGroup', 'text', array('label' => 'studentGroup'))
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('description', 'text', array('label' => 'description'))
            ->add('content', CKEditorType::class, array('label' => 'Content'))
            ->add('isModerated', 'checkbox')

        ;



    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title');
    }

}

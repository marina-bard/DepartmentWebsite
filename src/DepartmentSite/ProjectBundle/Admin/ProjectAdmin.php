<?php

namespace DepartmentSite\ProjectBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class ProjectAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('student', 'text', array('label' => 'Student'))
            ->add('teacher', 'text', array('label' => 'Teacher'))
            ->add('reviewer', 'textarea', array('label' => 'Reviewer comment'))
            ->add('course', 'number', array('label' => 'course'))
            ->add('studentGroup', 'text', array('label' => 'studentGroup'))
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('description', 'text', array('label' => 'description'))
            ->add('content', CKEditorType::class, array('label' => 'Content'));


        if($this->isCurrentRoute('edit')){
            $formMapper
                ->add('teacher_comment', 'textarea', array('label' => 'Teacher review'));
        }
        $formMapper
            ->add('isModerated', 'checkbox');




    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title');

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array())));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('student')
            ->add('teacher')
            ->add('reviewer')
            ->add('course')
            ->add('studentGroup')
            ->add('startDate')
            ->add('endDate')
            ->add('description')
            ->add('content')
            ->add('comments')
            ->add('isModerated')
        ;
    }

}

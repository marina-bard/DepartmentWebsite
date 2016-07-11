<?php

namespace DepartmentSite\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use ITM\FilePreviewBundle\Form\Type\FilePreviewType;
use ITM\ImagePreviewBundle\Form\Type\ImagePreviewType;
use Symfony\Component\HttpFoundation\File\File;

class NewsAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('description', 'text', array('label' => 'Description'))
            ->add('content', CKEditorType::class, array('label' => 'Content'))
             ->add('photo', ImagePreviewType::class, ['data_class' => null])
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
            ->addIdentifier('title')
            ->add('createdAt')
            ->add('photo', 'string', ['template' => 'DepartmentSiteNewsBundle:Admin:list__photo.html.twig'] )
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('createdAt')
            ->add('description')
            ->add('content')
            ->add('photo')
        ;
    }

}

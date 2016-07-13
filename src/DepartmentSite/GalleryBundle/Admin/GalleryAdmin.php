<?php

namespace DepartmentSite\GalleryBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use ITM\ImagePreviewBundle\Form\Type\ImagePreviewType;


class GalleryAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('description', 'text', array('label' => 'Description'))
            
        ;

        if ($this->isCurrentRoute('edit')) {
            $formMapper->add('images', 'sonata_type_collection', array(
                 ), array(
                'edit' => 'inline',
                'inline' => 'table'));

        }
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
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )))
        ;
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {

        $showMapper

            ->add('title', 'text', array('label' => 'Title'))
            ->add('description', 'text', array('label' => 'Description'))
            ->add('images',  'sonata_type_collection')
        ;

    }

}

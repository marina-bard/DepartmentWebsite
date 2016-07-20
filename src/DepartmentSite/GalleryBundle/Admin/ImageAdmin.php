<?php

namespace DepartmentSite\GalleryBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use ITM\ImagePreviewBundle\Form\Type\ImagePreviewType;

class ImageAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        if ($this->isCurrentRoute('create')) {
            $formMapper ->add('gallery', 'sonata_type_model_list', array('btn_delete'=> false, 'btn_add'=> false));

        }
        $formMapper
            ->add('image', ImagePreviewType::class, ['data_class' => null]);



    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('image' )
        ;
    }

    

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('image', 'sonata_type_model', ['template' => 'DepartmentSiteGalleryBundle:Admin:list__image.html.twig'] )
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )))
        ;
    }




}

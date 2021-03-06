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
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('description', 'text', array('label' => 'Description'))
            ->add('images', 'sonata_type_collection',
                array(
                    'required' => false,
                    'btn_add' => 'Добавить',
                    'type_options' => array('delete' => true),
                ),
                array('edit' => 'inline',
                    'inline' => 'table',
                ))
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper

            ->add('title', 'text', array('label' => 'Title'))
            ->add('description', 'text', array('label' => 'Description'))
            ->add('images',  'sonata_type_collection');
    }

    public function prePersist($gallery)
    {
        $this->preUpdate($gallery);
    }

    public function preUpdate($gallery)
    {
        $gallery->setImages($gallery->getImages());
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('DepartmentSiteGalleryBundle:CRUD:form_admin_fields.html.twig')
        );
    }
}

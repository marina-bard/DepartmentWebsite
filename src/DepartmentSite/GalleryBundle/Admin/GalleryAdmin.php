<?php

namespace DepartmentSite\GalleryBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class GalleryAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('description', 'text', array('label' => 'Description'))
            ->add('images', 'sonata_type_collection', array('required' => false,
                'by_reference' => false
            ), array(
                'edit' => 'inline',
                'sortable' => 'id',
            ))
        ;
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
        ;
    }


    public function prePersist($gallery)
    {
        var_dump($gallery->getId());
        $this->preUpdate($gallery);

//        foreach ($gallery->getImages() as $images) {
//            $images->setGallery($gallery);
//
//        }
    }

    public function preUpdate($gallery)
    {
        $gallery->setImages($gallery->getImages());
    }
}

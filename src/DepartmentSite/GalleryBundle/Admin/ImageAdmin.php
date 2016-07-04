<?php

namespace DepartmentSite\GalleryBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class ImageAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('gallery', 'entity', array(
                'class'    => 'DepartmentSite\GalleryBundle\Entity\Gallery'))
            ->add('image', 'text')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('image')
        ;
    }

    

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('image')
        ;
    }

    public function prePersist($image)
    {
        var_dump($image->getId());
    }
}

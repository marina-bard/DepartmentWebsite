<?php

namespace DepartmentSite\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
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
            // ->add('photo', ImagePreviewType::class, array('data_class' => 'DepartmentSite\NewsBundle\Entity\News')
            ->add('photo', ImagePreviewType::class, array('data_class' => null))
            // ->add('photo', null, ['template' => 'DepartmentSiteNewsBundle:Preview:photo.preview.show.html.twig'])
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
        ;
    }

//    protected function configureShowFields(ShowMapper $showMapper)
//    {
//        $showMapper
//            ->add('title')
//            ->add('description')
//            ->add('content')
//            ->add('photo', 'null', (array('template' => 'DepartmentSiteNewsBundle:Preview:photo.preview.show.html.twig')))
//        ;
//    }
}

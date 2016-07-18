<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 17.7.16
 * Time: 21.05
 */

namespace DepartmentSite\MenuBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use ITM\ImagePreviewBundle\Form\Type\ImagePreviewType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class SideBarMenuAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('translations', TranslationsType::class)
            ->add('value', 'text', array('label' => 'Value'))
            ->add('photo', ImagePreviewType::class, ['data_class' => null])
        ;
    }
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
//            ->remove('create')
            ->remove('delete')
        ;

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title');
    }
}
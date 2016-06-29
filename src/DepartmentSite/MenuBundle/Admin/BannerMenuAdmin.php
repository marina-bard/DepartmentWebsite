<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 22.6.16
 * Time: 15.22
 */

namespace DepartmentSite\MenuBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class BannerMenuAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('translations', TranslationsType::class )
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('delete')
        ;

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title');
        ;
    }
}
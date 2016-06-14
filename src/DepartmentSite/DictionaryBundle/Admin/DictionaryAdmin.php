<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14.6.16
 * Time: 15.50
 */

namespace DepartmentSite\DictionaryBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class DictionaryAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('dictionary', 'text')
            ->add('facebookLink', 'text')
            ->add('twiterLink', 'text')
            ->add('instagramLink', 'text')
            ->add('phone', 'text')
            ->add('address', 'text')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('vkLink')
            ->add('facebookLink')
            ->add('address')
        ;
    }
}
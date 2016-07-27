<?php

namespace Application\FOS\UserBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;



class UserAdmin extends AbstractAdmin
{

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');

    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
            $formMapper
                ->add('username', 'text', array('attr' => array(
                    'readonly' => true)))
                ->add('email', 'text', array('attr' => array(
                    'readonly' => true)))
                ->add('locked', 'checkbox', array('required' => false))
                //->add('roles')

            ;

    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')

        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username', 'text')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )))
        ;
            
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {

        $showMapper
            ->add('username')
            ->add('email')
            ->add('locked')
        ;         

    }



}

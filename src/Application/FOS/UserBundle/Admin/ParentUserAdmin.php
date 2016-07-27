<?php

namespace Application\FOS\UserBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;



class ParentUserAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        if ($this->isCurrentRoute('edit')) {
            $formMapper
                ->add('username', 'text', array('label' => 'User Name', 'attr' => array(
                    'readonly' => true)))
                ->add('name', 'text', array('label' => ' Name', 'attr' => array(
                    'readonly' => true)))
                ->add('surname', 'text', array('label' => 'Surname', 'attr' => array(
                    'readonly' => true)))
                ->add('patronymic', 'text', array('label' => 'Patronymic', 'attr' => array(
                    'readonly' => true)))
                ->add('email', 'text', array('label' => 'Email', 'attr' => array(
                    'readonly' => true)))
                ->add('studyGroup', 'integer', array('label' => 'Study Group', 'attr' => array(
                    'readonly' => true)))

            ;
        }
        else {
            $formMapper
                ->add('username', 'text', array('label' => 'User Name'))
                ->add('name', 'text', array('label' => ' Name'))
                ->add('surname', 'text', array('label' => 'Surname'))
                ->add('patronymic', 'text', array('label' => 'Patronymic'))
                ->add('email', 'text', array('label' => 'Email'))
                ->add('studentGroup', 'integer', array('label' => 'Study Group'))
                ->add('password', 'text')


            ;
        }
        $formMapper
            ->add('locked', 'checkbox');

        // ->add('roles', 'sonata_type_model_list' )



    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('name')
            ->add('surname')
            ->add('patronymic')
            ->add('email')
            ->add('studentGroup')
            ->add('locked')
            //->add('roles')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('surname')
            ->add('patronymic')
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
            ->add('name')
            ->add('surname')
            ->add('patronymic')
            ->add('email')
            ->add('studentGroup')
            ->add('locked')
        ;



    }



}

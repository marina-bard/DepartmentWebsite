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
        $roles = ['Администратор'=>"ROLE_ADMIN",
            "Доступ к пользователям"=> "USERS",
        "Доступ к студентам" => "STUDENT_USER",
        "Доступ к родителям" => "PARENT_USER",
        "Доступ к преподавателям" => "TEACHER_USER",
        "Доступ к проектам" => "PROJECTS",
        "Доступ к комментариям" => "COMMENT",
        "Доступ к словарю" => "DICTIONARY",
        "Доступ к объявлениям"=> "NOTICE",
        "Доступ к галереи" => "GALLERY",
        "Доступ к меню" => "MENU",
        "Доступ к новостям" => "NEWS",
        "Доступ к страницам" => "PAGE",
        "Доступ к слайд-шоу" => "SLIDE_SHOW"];
        $formMapper
                ->add('username', 'text', array('attr' => array(
                    'readonly' => true)))
                ->add('email', 'text', array('attr' => array(
                    'readonly' => true)))
                ->add('locked', 'checkbox', array('required' => false));
        if(in_array('ROLE_SUPER_ADMIN', $this->getCurrentUser()->getRoles())){
            $formMapper
            ->add('roles', 'choice', array(
                'choices' => $roles, 'multiple' => true));
        }

    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
//            ->add('type')


        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username', 'text')
            ->add('type', 'text')
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
            ->add('roles')
        ;         

    }

    private function getCurrentUser()
    {
        /**
         * @var UserInterface $user
         */
        $user = $this->getConfigurationPool()
            ->getContainer()
            ->get('security.token_storage')
            ->getToken()
            ->getUser();

        return $user;
    }



}

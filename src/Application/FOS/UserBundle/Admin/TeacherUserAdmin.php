<?php

namespace Application\FOS\UserBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;



class TeacherUserAdmin extends AbstractAdmin
{

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
                ->add('plainPassword', 'repeated', array(
                    'required' => false,
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch' ));
                

            ;
        }
        else {
            $formMapper
                ->add('username', 'text', array('label' => 'User Name'))
                ->add('name', 'text', array('label' => ' Name'))
                ->add('surname', 'text', array('label' => 'Surname'))
                ->add('patronymic', 'text', array('label' => 'Patronymic'))
                ->add('email', 'text', array('label' => 'Email'))
                ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch'));


            ;
        }
        $formMapper
            ->add('enabled', 'checkbox', array('required' => false));
        if(in_array('ROLE_SUPER_ADMIN', $this->getCurrentUser()->getRoles())){
            $formMapper
                ->add('roles', 'choice', array(
                    'choices' => $roles, 'multiple' => true));
        }



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
            ->add('enabled')
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
            ->add('roles')
            ->add('enabled')
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

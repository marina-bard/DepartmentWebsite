<?php

namespace Application\FOS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Application\FOS\UserBundle\Form\Type\RegistrationStudentUserFormType;
use Application\FOS\UserBundle\Form\Type\RegistrationParentUserFormType;
use Application\FOS\UserBundle\Form\Type\RegistrationTeacherUserFormType;

class RegistrationUserController extends Controller
{
    public function registerAction()
    {
        $users = [
            'unsigned' => null,
            'teacher_user' => 'teacher',
            'student_user' => 'student',
            'parent_user' => 'parent'
        ];

        return $this->render('ApplicationFOSUserBundle:Registration:choose_user.form.html.twig', array(
            'users' => $users
        ));
//        return $this->container
//            ->get('pugx_multi_user.registration_manager')
//            ->register('Application\FOS\UserBundle\Entity\StudentUser');
    }

    public function getFormAction($user)
    {
        if(is_null($user)) {
            return new Response();
        }
//        $service = $this->get('fos.user.'.$user);
//        return $this->container
//            ->get('pugx_multi_user.registration_manager')
//            ->register(get_class($service));
        $form = $this->createForm(RegistrationStudentUserFormType::class);
////        var_dump($form);
//        return $this->render('ApplicationFOSUserBundle:Registration:form.html.twig', array(
//            'form' => $form->createView()
//        ));
        return $this->render('FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function registerStudentUserAction()
    {
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('Application\FOS\UserBundle\Entity\StudentUser');
    }

    public function registerParentUserAction()
    {
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('Application\FOS\UserBundle\Entity\ParentUser');
    }

    public function registerTeacherUserAction()
    {
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('Application\FOS\UserBundle\Entity\TeacherUser');
    }
}
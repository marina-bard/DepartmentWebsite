<?php

namespace Application\FOS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RegistrationUserController extends Controller
{
    public function registerAction()
    {
        $users = [
            'teacher_user' => 'teacher',
            'student_user' => 'student',
            'parent_user' => 'parent'
        ];
        return $this->render('ApplicationFOSUserBundle:Registration:choose_user.form.html.twig', array(
            'users' => $users
        ));
    }

    public function getFormAction($user)
    {
        $service = $this->get('fos.user.'.$user);
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register(get_class($service));
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
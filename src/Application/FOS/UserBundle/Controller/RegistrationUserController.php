<?php

namespace Application\FOS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationUserController extends Controller
{
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
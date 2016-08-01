<?php

namespace Application\FOS\UserBundle\Controller;

use Application\FOS\UserBundle\ApplicationFOSUserBundle;
use Symfony\Bridge\Doctrine\Tests\Fixtures\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RegistrationUserController extends Controller
{
    private $users = [
        'teacher_user' => 'teacher',
        'student_user' => 'student',
        'parent_user' => 'parent'
    ];

    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function registerAction(Request $request)
    {
        if($request->request->all()) {
            return $this->get('pugx_multi_user.registration_manager')->register($this->getUserClassName(key($request->request->all())));
        } else {
            return $this->render('ApplicationFOSUserBundle:Registration:choose_user.form.html.twig', array(
                'users' => $this->users,
            ));
        }
    }

    public function getFormAction(Request $request)
    {
        $type = $request->get('type');
        return $this->get('pugx_multi_user.registration_manager')->register($this->getUserClassName($type));
    }

    public function getUserClassName($user)
    {
        switch($user) {
            case 'student':
                return 'Application\FOS\UserBundle\Entity\StudentUser';
                break;
            case 'fos_user_registration_form_student_user':
                return 'Application\FOS\UserBundle\Entity\StudentUser';
                break;
            case 'parent':
                return 'Application\FOS\UserBundle\Entity\ParentUser';
                break;
            case 'fos_user_registration_form_parent_user':
                return 'Application\FOS\UserBundle\Entity\ParentUser';
                break;
            case 'teacher':
                return 'Application\FOS\UserBundle\Entity\TeacherUser';
                break;
            case 'fos_user_registration_form_teacher_user':
                return 'Application\FOS\UserBundle\Entity\TeacherUser';
                break;
        }
    }
}
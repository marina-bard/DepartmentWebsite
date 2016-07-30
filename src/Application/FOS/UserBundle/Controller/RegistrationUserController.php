<?php

namespace Application\FOS\UserBundle\Controller;

use Application\FOS\UserBundle\ApplicationFOSUserBundle;
use Symfony\Bridge\Doctrine\Tests\Fixtures\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Application\FOS\UserBundle\Form\Type\RegistrationStudentUserFormType;
use Application\FOS\UserBundle\Form\Type\RegistrationParentUserFormType;
use Application\FOS\UserBundle\Form\Type\RegistrationTeacherUserFormType;
use Symfony\Component\HttpFoundation\Request;

class RegistrationUserController extends Controller
{
    private $users = [
        'teacher_user' => 'teacher',
        'student_user' => 'student',
        'parent_user' => 'parent'
    ];

    /**
     * Method regi
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function registerAction(Request $request)
    {
//        preg_match('/.%/', $request->getContent(), $matches);
//        var_dump(print_r($matches));

        if($request->request->all()) {
//            var_dump($request->request->all());
            return $this->forward('FOSUserBundle:Registration:register');
        } else {
            return $this->render('ApplicationFOSUserBundle:Registration:choose_user.form.html.twig', array(
                'users' => $this->users,
            ));
        }

//        if (count($request_student_data)) {
//            $form = $this->createForm(RegistrationStudentUserFormType::class);
//
//            $form->handleRequest($request);
//
//            if ( $form->isValid() && $form->isSubmitted() ) {
//                $student_user = $form->getData();
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($student_user);
//                $em->flush();
//
//                return new JsonResponse('success');
//            }
//        }
//        return $this->container
//            ->get('pugx_multi_user.registration_manager')
//            ->register('Application\FOS\UserBundle\Entity\StudentUser');
    }

    public function getFormAction(Request $request)
    {
        $type = $request->get('type');
        var_dump($type);
        return $this->get('pugx_multi_user.registration_manager')->register($this->getUserClassName($type));


//        if(is_null($user)) {
//            return new Response();
//        }
//        $userType = $request->get('type');
//
//        if($userType == 'student')
//            $form = $this->createForm(RegistrationStudentUserFormType::class);
//        else if($userType == 'parent')
//            $form = $this->createForm(RegistrationParentUserFormType::class);
//        else if($userType == 'teacher')
//            $form = $this->createForm(RegistrationTeacherUserFormType::class);
//
//        return $this->render('FOSUserBundle:Registration:register.html.twig', array(
//            'form' => $form->createView(),
//        ));
    }

    public function getUserClassName($user)
    {
        switch($user) {
            case 'student':
                return 'Application\FOS\UserBundle\Entity\StudentUser';
                break;
            case 'parent':
                return 'Application\FOS\UserBundle\Entity\ParentUser';
                break;
            case 'teacher':
                return 'Application\FOS\UserBundle\Entity\TeacherUser';
                break;
        }
    }
}
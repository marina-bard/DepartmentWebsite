<?php

namespace Application\FOS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationParentUserController extends Controller
{
    public function registerAction()
    {
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('Application\FOS\UserBundle\Entity\ParentUser');
    }
}
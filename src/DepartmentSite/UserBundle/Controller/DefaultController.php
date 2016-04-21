<?php

namespace DepartmentSite\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DepartmentSiteUserBundle:Default:index.html.twig');
    }
}

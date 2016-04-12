<?php

namespace DepartmentSite\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DepartmentSiteNewsBundle:Default:index.html.twig');
    }
}

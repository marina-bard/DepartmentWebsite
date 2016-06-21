<?php

namespace DepartmentSite\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DepartmentSitePageBundle:Default:index.html.twig');
    }
}

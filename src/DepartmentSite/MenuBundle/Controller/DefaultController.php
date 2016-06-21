<?php

namespace DepartmentSite\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DepartmentSiteMenuBundle:Default:index.html.twig');
    }
}

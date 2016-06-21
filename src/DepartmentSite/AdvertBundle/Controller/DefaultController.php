<?php

namespace DepartmentSite\AdvertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DepartmentSiteAdvertBundle:Default:index.html.twig');
    }
}

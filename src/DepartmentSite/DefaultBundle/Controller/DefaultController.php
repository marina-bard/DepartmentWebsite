<?php

namespace DepartmentSite\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DepartmentSite\NewsBundle\DepartmentSiteNewsBundle;
use DepartmentSite\NewsBundle\Entity\News;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$news_list = $em->getRepository('DepartmentSiteNewsBundle:News')->findBy(array(), array('id'=>'desc'), 5);
        $adver_list = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findBy(array(), array('id'=>'desc'), 5);
        return $this->render('DepartmentSiteDefaultBundle:Default:index.html.twig',
            array('adverts'=>$adver_list));
    }
}

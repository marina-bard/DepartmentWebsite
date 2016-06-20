<?php

namespace DepartmentSite\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DepartmentSite\NewsBundle\DepartmentSiteNewsBundle;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        $em = $this->getDoctrine()->getManager();
//        $news_list = $em->getRepository('DepartmentSiteNewsBundle:News')->findBy(array(), array('id'=>'desc'), 5);
//        $adver_list = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findBy(array(), array('id'=>'desc'), 5);
        return $this->render('DepartmentSiteDefaultBundle:Default:index.html.twig');
    }
    
    public function getAdvertsForMainPageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findBy(array(), array('id'=>'desc'), 6);

        $serialized = $this->container->get('serializer')->serialize($adverts, 'json');
        return new Response($serialized);
    }

    public function getNewsForMainPageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('DepartmentSiteNewsBundle:News')->findBy(array(), array('id'=>'desc'), 4);

        $serialized = $this->container->get('serializer')->serialize($news, 'json');
        return new Response($serialized);
    }
}

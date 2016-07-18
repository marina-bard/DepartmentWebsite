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
    public function indexAction($_locale)
    {
//        $em = $this->getDoctrine()->getManager();
//        $news_list = $em->getRepository('DepartmentSiteNewsBundle:News')->findBy(array(), array('id'=>'desc'), 5);
//        $adver_list = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findBy(array(), array('id'=>'desc'), 5);
        return $this->render('DepartmentSiteDefaultBundle:Default:index.html.twig', array('_locale' => $_locale));
    }

    public function getAdvertsForMainPageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findBy(array(), array('id'=>'desc'), 6);

        return new Response(htmlspecialchars(json_encode($adverts, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function getNewsForMainPageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('DepartmentSiteNewsBundle:News')->findBy(array(), array('id'=>'desc'), 4);

        foreach($news as $oneNews) {
            $oneNews->setPhoto($this->get('itm.file.preview.path.resolver')->getUrl($oneNews, $oneNews->getPhoto()));
        }

        return new Response(htmlspecialchars(json_encode($news, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function getHeaderMenuAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $headerMenu = $em->getRepository('DepartmentSiteMenuBundle:HeaderMenu')->findall();
        return $this->render('@DepartmentSiteDefault/layout/headerMenu.html.twig', array('menu' => $headerMenu,
            '_locale' => $_locale));
    }

    public function getBannerMenuAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $bannerMenu = $em->getRepository('DepartmentSiteMenuBundle:BannerMenu')->findall();
        return $this->render('@DepartmentSiteDefault/layout/bannerMenu.html.twig', array('menu' => $bannerMenu,
            '_locale' => $_locale));
    }

}

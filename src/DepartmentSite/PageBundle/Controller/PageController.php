<?php

namespace DepartmentSite\PageBundle\Controller;

use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DepartmentSite\PageBundle\Entity\Page;
use DepartmentSite\PageBundle\Form\PageType;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{
//    /**
//     * Lists all Page entities.
//     *
//     */
//    public function indexAction($locale)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $pages = $em->getRepository('DepartmentSitePageBundle:Page')->findAll();
//
//        return $this->render('DepartmentSitePageBundle:Page:index.html.twig', array(
//            'pages' => $pages,
//            'locale' => $locale
//        ));
//    }

    
    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction(Page $page, $locale, $slug)
    {
//        $em = $this->getDoctrine()->getManager();
//        $page = $em->getRepository('DepartmentSitePageBundle:Page')->findBy(array('slug'=>$slug));
          return $this->render('DepartmentSitePageBundle:Page:show.html.twig', array(
            'page' => $page, '_locale' => $locale
        ));
//
//        return new Response(var_dump($page));
    }


    
    

    public function getPageBySlugAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('DepartmentSitePageBundle:Page')->findBy(array('slug'=>$slug));
       // var_dump($page);
        $serialized = $this->container->get('serializer')->serialize($page, 'json');
        return new Response($serialized);
    }
}

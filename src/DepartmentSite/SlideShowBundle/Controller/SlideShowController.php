<?php

namespace DepartmentSite\SlideShowBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DepartmentSite\SlideShowBundle\Entity\SlideShow;
use DepartmentSite\SlideShowBundle\Form\SlideShowType;

/**
 * SlideShow controller.
 *
 */
class SlideShowController extends Controller
{
    /**
     * Lists all SlideShow entities.
     *
     */
//    public function indexAction($locale)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $slideShow = $em->getRepository('DepartmentSiteSlideShowBundle:SlideShow')->findAll();
//
//        foreach($slideShow as &$slide) {
//            $slide->setImage($this->get('itm.file.preview.path.resolver')->getUrl($slide, $slide->getImage()));
//        }
//        return $this->render(':layout:banner.html.twig', array(
//            'slideShows' => $slideShow,
//        ));
//    }
    public function indexAction($locale)
    {
        $em = $this->getDoctrine()->getManager();
        $slideShow = $em->getRepository('DepartmentSiteSlideShowBundle:SlideShow')->findAll();
        foreach($slideShow as &$slide) {
            $slide->setImage($this->get('itm.file.preview.path.resolver')->getUrl($slide, $slide->getImage()));
        }
        return $this->render(':layout:banner.html.twig', array(
            'slideShows' => $slideShow,
            '_locale' => $locale,
        ));
    }
}

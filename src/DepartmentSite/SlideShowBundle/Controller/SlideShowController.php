<?php

namespace DepartmentSite\SlideShowBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DepartmentSite\SlideShowBundle\Entity\SlideShow;
use DepartmentSite\SlideShowBundle\Form\SlideShowType;

/**
 * SlideShow controller.
 *
 */
class SlideShowController extends Controller
{
    /**
     * @Route(
     *     "/{locale}/slideshow/",
     *      name="slideshow_index",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET"})
     * @Template("layout/banner.html.twig")
     */
    public function indexAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $slideShow = $em->getRepository('DepartmentSiteSlideShowBundle:SlideShow')->findAll();
        foreach($slideShow as &$slide) {
            $url = $this->get('itm.file.preview.path.resolver')->getUrl($slide, $slide->getImage());
            $slide->setImage($url);
        }
        return array(
            'slideShows' => $slideShow,
            '_locale' => $_locale,
        );
    }
}

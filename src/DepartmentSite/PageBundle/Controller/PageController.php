<?php

namespace DepartmentSite\PageBundle\Controller;

use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DepartmentSite\PageBundle\Entity\Page;
use DepartmentSite\PageBundle\Form\PageType;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{
    /**
     * Finds and displays a Page entity.
     *
     * @Route(
     *     "/{_locale}/{slug}/show",
     *      name="page_show",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"}
     *     )
     * @Method({"GET"})
     * @Template
     */
    public function showAction(Page $page, $_locale, $slug)
    {
    }

    public function getPageBySlugAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('DepartmentSitePageBundle:Page')->findBy(array('slug'=>$slug));

        return new Response(htmlspecialchars(json_encode($page, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }
}

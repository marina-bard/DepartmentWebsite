<?php

namespace DepartmentSite\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DepartmentSite\NewsBundle\Entity\News;
use Symfony\Component\HttpFoundation\Response;

/**
 * News controller.
 *
 */
class NewsController extends Controller
{

     const NEWS_COUNT = 10;
    /**
     * Lists all News entities.
     *
     * @Route(
     *     "/{_locale}/news/{page}/",
     *      name="news_index",
     *      defaults={"_locale": "ru", "page" : "1"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET"})
     * @Template("DepartmentSiteNewsBundle:News:news.html.twig")
     */
    public function indexAction($_locale, $page)
    {
        $request = new Request();
        $news= $this->getDoctrine()
            ->getManager()
            ->createQueryBuilder()
            ->select('news')
            ->from('DepartmentSiteNewsBundle:News', 'news')
            ->orderBy('news.createdAt', 'DESC');

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $news,
            $request->query->get('page', $page),
            self::NEWS_COUNT
        );
        
        return $this->render('DepartmentSiteNewsBundle:News:news.html.twig',
          array('page' => $page,
          '_locale' => $_locale,
          'pagination' => $pagination));
    }

    public function getAllAction( $pagination) {
        $news = (Object)$pagination->getItems();
        foreach($news as &$oneNews) {
            $url = $this->get('itm.file.preview.path.resolver')->getUrl($oneNews, $oneNews->getPhoto());
            $oneNews->setPhoto($url);
        }

        return new Response(htmlspecialchars(json_encode($news, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    /**
     * Finds and displays a News entity.
     *
     * @Route(
     *     "/{_locale}/news/{slug}/show",
     *      name="news_show",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET"})
     * @Template
     */
    public function showAction(Request $request, News $news, $_locale)
    {

    }
    

}

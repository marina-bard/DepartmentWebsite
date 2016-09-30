<?php

namespace DepartmentSite\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DepartmentSite\NewsBundle\Entity\News;
use DepartmentSite\NewsBundle\Form\NewsType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use ITM\ImagePreviewBundle\Resolver\PathResolver;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;

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
        $news= $this->getNews();

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

    public function getNewsAction( $pagination) {
        $news = (Object)$pagination->getItems();
        foreach($news as &$oneNews) {
            $oneNews->setPhoto( $this->setNewsPhotoUrls($oneNews->getId()));
        }

        return new Response(htmlspecialchars(json_encode($news, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function setNewsPhotoUrls($id)
    {
        $em = $this->getDoctrine()->getManager();
        $oneNews = $em->getRepository('DepartmentSiteNewsBundle:News')->findOneBy(['id' => $id]);
        $url = $this->get('itm.file.preview.path.resolver')->getUrl($oneNews, $oneNews->getPhoto());
        return $url;
    }
    

    public function getNews(){
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteNewsBundle:News');

        $query = $repository->createQueryBuilder('a')
            ->select()
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery();
        return $query->getResult();
    }

}

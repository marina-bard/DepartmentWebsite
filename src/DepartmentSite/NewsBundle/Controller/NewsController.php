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

/**
 * News controller.
 *
 */
class NewsController extends Controller
{
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

//    public function escapeChars($value)
//    {
//        $escaper = array("\"");
//        $replacements = array("\\\\");
//        $result = str_replace($escaper, $replacements, $value);
//        return $result;
//    }
    
    public function getNewsLengthAction() {
        $count = $this->getCount();
        return new Response($count);
    }


    public function  getNewsPaginationAction($page) {
        $count = $this->getCount();
        return $this->render('layout/pagination.html.twig', array('listLength' => $count, 'page' => $page));
    }
    
    public function getNewsAction($page) {
        $news_per_page = 10;
        $news = $this->getNextPage(($page-1)*$news_per_page,$news_per_page );
        foreach($news as &$oneNews) {
            $oneNews['photo'] = $this->setNewsPhotoUrls($oneNews['id']);
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

    public function getCount(){
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteNewsBundle:News');

        $query = $repository->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function getNextPage($offset, $limit){
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteNewsBundle:News');

        $query = $repository->createQueryBuilder('a')
            ->select()
            ->orderBy('a.createdAt', 'DESC')
            ->setFirstResult( $offset )
            ->setMaxResults( $limit )
            ->getQuery();
        return $query->getArrayResult();
    }

}

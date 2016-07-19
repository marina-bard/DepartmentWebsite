<?php

namespace DepartmentSite\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DepartmentSite\NewsBundle\Entity\News;
use DepartmentSite\NewsBundle\Form\NewsType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use ITM\ImagePreviewBundle\Resolver\PathResolver;



/**
 * News controller.
 *
 * @Route("/news")
 */
class NewsController extends Controller
{
    /**
     * Lists all News entities.
     *
     */
    public function indexAction($_locale, $page)
    {
        return $this->render('DepartmentSiteNewsBundle:News:news.html.twig', array('page' => $page, '_locale' => $_locale));
    }

    /**
     * Finds and displays a News entity.
     *
     *     defaults = {"_format"="html|json"},
     */
    public function showAction(Request $request, News $news, $_locale)
    {
        return $this->render('DepartmentSiteNewsBundle:News:show.html.twig', array(
            'news' => $news,
            '_locale' => $_locale
        ));
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
        $sql_request = "SELECT * FROM News ORDER BY createdAt DESC LIMIT " . (($page-1)*$news_per_page) . ", " . $news_per_page;
        $em = $this->getDoctrine()->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($sql_request);
        $statement->execute();
        $news = $statement->fetchAll();

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

        var_dump($query->getArrayResult());
    }

}

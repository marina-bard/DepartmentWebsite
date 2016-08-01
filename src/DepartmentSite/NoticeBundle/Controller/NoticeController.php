<?php
namespace DepartmentSite\NoticeBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DepartmentSite\NoticeBundle\Entity\Notice;
use DepartmentSite\NoticeBundle\Form\NoticeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Query;
/**
 * Notice controller.
 *
 */
class NoticeController extends Controller
{
    /**
     * Lists all Notice entities.
     *
     * @Route(
     *     "/{_locale}/notice/{page}/",
     *      name="notice_index",
     *      defaults={"_locale": "ru", "page" = "1"},
     *      requirements = {"_locale" = "ru|en"}
     *     )
     * @Method({"GET"})
     * @Template
     */
    public function indexAction($_locale, $page)
    {
    }

    /**
     * Finds and displays a Notice entity.
     *
     * @Route(
     *     "/{_locale}/notice/{slug}/show",
     *      name="notice_show",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"}
     *     )
     * @Method({"GET"})
     * @Template
     */
    public function showAction(Notice $notice, $_locale)
    {
    }


    public function getNoticesLengthAction() {
          $count = $this->getCount();
        return new Response($count);
    }

    public function  getNoticesPaginationAction($page) {

        $count = $this->getCount();
        return $this->render('layout/pagination.html.twig', array('listLength' => $count, 'page' => $page));
    }

    public function getNoticesAction($page) {
        $adv_per_page = 10;
        $notices = $this->getNextPage(($page-1)*$adv_per_page, $adv_per_page);
        $serialized = $this->container->get('serializer')->serialize($notices, 'json');
       
        return new Response($serialized);
    }

    public function getAllAction() {
        $em = $this->getDoctrine()->getManager();
        $notices = $em->getRepository('DepartmentSiteNoticeBundle:Notice')->findAll();
        return new Response(htmlspecialchars(json_encode($notices, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function getCount(){
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteNoticeBundle:Notice');

        $query = $repository->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function getNextPage($offset, $limit){
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteNoticeBundle:Notice');

        $query = $repository->createQueryBuilder('a')
            ->select()
            ->orderBy('a.createdAt', 'DESC')
            ->setFirstResult( $offset )
            ->setMaxResults( $limit )
            ->getQuery();

        return $query->getArrayResult();
    }

}
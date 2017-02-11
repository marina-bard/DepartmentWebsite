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

    const NOTICES_COUNT = 10;
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
        $request = new Request();
        $notices = $this->getDoctrine()
            ->getManager()
            ->createQueryBuilder()
            ->select('notice')
            ->from('DepartmentSiteNoticeBundle:Notice', 'notice')
            ->orderBy('notice.createdAt', 'DESC');

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $notices,
            $request->query->get('page', $page),
            self::NOTICES_COUNT
        );

        return $this->render('DepartmentSiteNoticeBundle:Notice:index.html.twig',
            array('page' => $page,
                '_locale' => $_locale,
            'pagination' => $pagination));
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
     */
    public function showAction(Notice $notice, $_locale)
    {
        return $this->render('DepartmentSiteNoticeBundle:Notice:show.html.twig',
            array('notice' => $notice,
                '_locale' => $_locale));

    }


    public function getNoticesAction( $pagination) {
        $notices = (Object)$pagination->getItems();
        return new JsonResponse($notices);

    }

    public function getAllAction() {
        $em = $this->getDoctrine()->getManager();
        $notices = $em->getRepository('DepartmentSiteNoticeBundle:Notice')->findAll();
        return new Response(htmlspecialchars(json_encode($notices, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }
    

    public function getNotices(){
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteNoticeBundle:Notice');

        $query = $repository->createQueryBuilder('a')
            ->select()
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery();

        return $query->getResult();
    }

}
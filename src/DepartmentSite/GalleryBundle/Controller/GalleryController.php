<?php

namespace DepartmentSite\GalleryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DepartmentSite\GalleryBundle\Entity\Gallery;
use DepartmentSite\GalleryBundle\Form\GalleryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Gallery controller.
 *
 */
class GalleryController extends Controller
{

    const GALLERIES_COUNT = 10;

    /**
     * Lists all Gallery entities.
     *
     * @Route(
     *     "/{_locale}/gallery/{page}/",
     *      name="gallery_index",
     *      defaults={"_locale": "ru", "page" = "1"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET"})
     * @Template
     */
    public function indexAction($_locale, $page)
    {
        $request = new Request();
        $galleries = $this->getGalleries();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $galleries,
            $request->query->get('page', $page),
            self::GALLERIES_COUNT
        );

        return $this->render('DepartmentSiteGalleryBundle:Gallery:index.html.twig', array(
            'page' => $page,
            'galleries' => $galleries,
            '_locale' => $_locale,
            'pagination' => $pagination
        ));
    }


    public function getGalleries(){
        return $this->getDoctrine()
            ->getRepository('DepartmentSiteGalleryBundle:Gallery')
            ->findBy(array(), array('createdAt' => 'DESC'));

//        $repository = $this->getDoctrine()
//            ->getRepository('DepartmentSiteGalleryBundle:Gallery');

//        $query = $repository->createQueryBuilder('a')
//            ->select()
//            ->orderBy('a.createdAt', 'DESC')
//            ->getQuery();
//
//        return $query->getResult();
    }

    /**
     * Finds and displays a Gallery entity.
     *
     * @Route(
     *     "/{_locale}/gallery/{id}/show",
     *      name="gallery_show",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET"})
     * @Template
     *
     */
    public function showAction(Gallery $gallery, $_locale)
    {
        return array(
            'gallery' => $gallery,
            '_locale' => $_locale
        );
    }
       

    public function getAllAction($pagination)
    {
        $images = $this->getDoctrine()->getRepository('DepartmentSiteGalleryBundle:Image')->findAll();

        $galleries = (Object)$pagination->getItems();
        foreach ($galleries as &$galleryItem) {
            $url = $this->get('itm.file.preview.path.resolver')->getUrl($galleryItem->getFirstImageItem(), $galleryItem->getFirstImageItem()->getImage());
            $galleryItem->setImage($url);
        }

        return new Response(htmlspecialchars(json_encode($galleries, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }
}




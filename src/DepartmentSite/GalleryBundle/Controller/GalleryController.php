<?php

namespace DepartmentSite\GalleryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteGalleryBundle:Gallery');

        $query = $repository->createQueryBuilder('a')
            ->select()
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Finds and displays a Gallery entity.
     *
     */
    public function showAction(Gallery $gallery, $_locale)
    {
        return $this->render('DepartmentSiteGalleryBundle:Gallery:show.html.twig', array(
            'gallery' => $gallery,
            '_locale' => $_locale
        ));
    }
       

    public function getAllAction($pagination)
    {
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository('DepartmentSiteGalleryBundle:Image')->findAll();

        $galleries = (Object)$pagination->getItems();
        foreach ($galleries as &$gallery_temp){
            $gallery_temp->setImage($this->get('itm.file.preview.path.resolver')->getUrl($images[0], $gallery_temp->getFirstImage()));
        }


        return new JsonResponse($galleries);
    }
}




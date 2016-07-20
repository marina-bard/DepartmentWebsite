<?php

namespace DepartmentSite\GalleryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DepartmentSite\GalleryBundle\Entity\Gallery;
use DepartmentSite\GalleryBundle\Form\GalleryType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Gallery controller.
 *
 */
class GalleryController extends Controller
{
    /**
     * Lists all Gallery entities.
     *
     */
    public function indexAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();

        $galleries = $em->getRepository('DepartmentSiteGalleryBundle:Gallery')->findAll();

        return $this->render('DepartmentSiteGalleryBundle:Gallery:index.html.twig', array(
            'galleries' => $galleries,
            '_locale' => $_locale
        ));
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

/**
* Creates a form to delete a Gallery entity.
*
* @param Gallery $gallery The Gallery entity
*
* @return \Symfony\Component\Form\Form The form
*/
    private function createDeleteForm(Gallery $gallery)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gallery_delete', array('id' => $gallery->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function getAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $galleries = $em->getRepository('DepartmentSiteGalleryBundle:Gallery')->findAll();
        $images= $em->getRepository('DepartmentSiteGalleryBundle:Image')->findAll();

        foreach ($galleries as &$gallery ) {
            $gallery->setImage($this->get('itm.file.preview.path.resolver')->getUrl($images[0], $gallery->getFirstImage()));
        }
        return new Response(htmlspecialchars(json_encode($galleries, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }
}

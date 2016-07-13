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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galleries = $em->getRepository('DepartmentSiteGalleryBundle:Gallery')->findAll();

        return $this->render('DepartmentSiteGalleryBundle:Gallery:index.html.twig', array(
            'galleries' => $galleries,
        ));
    }


    /**
     * Finds and displays a Gallery entity.
     *
     */
    public function showAction(Gallery $gallery)
    {
        return $this->render('DepartmentSiteGalleryBundle:Gallery:show.html.twig', array(
            'gallery' => $gallery
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

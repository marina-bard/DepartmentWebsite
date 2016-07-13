<?php

namespace DepartmentSite\GalleryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DepartmentSite\GalleryBundle\Entity\Image;
use DepartmentSite\GalleryBundle\Form\ImageType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Image controller.
 *
 */
class ImageController extends Controller
{
    /**
     * Lists all Image entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $images = $em->getRepository('DepartmentSiteGalleryBundle:Image')->findAll();

        return $this->render('DepartmentSiteGalleryBundle:Image:index.html.twig', array(
            'images' => $images,
        ));
    }


    /**
     * Finds and displays a Image entity.
     *
     */
    public function showAction(Image $image)
    {
        $deleteForm = $this->createDeleteForm($image);

        return $this->render('DepartmentSiteGalleryBundle:Image:show.html.twig', array(
            'image' => $image,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    
    public function getAllAction($galleryTitle = "gallery")
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('DepartmentSiteGalleryBundle:Gallery')->findOneBy(['title' => $galleryTitle]);
        $images = $em->getRepository('DepartmentSiteGalleryBundle:Image')->findBy(['gallery' => $gallery]);

        foreach ($images as &$image) {
            $image->setImage($this->get('itm.file.preview.path.resolver')->getUrl($image, $image->getImage()));
        }
        return new Response(htmlspecialchars(json_encode($images, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }
}

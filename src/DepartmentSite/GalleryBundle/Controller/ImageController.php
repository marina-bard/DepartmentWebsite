<?php

namespace DepartmentSite\GalleryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DepartmentSite\GalleryBundle\Entity\Image;
use DepartmentSite\GalleryBundle\Form\ImageType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Image controller.
 *
 */
class ImageController extends Controller
{
    public function getAllAction($galleryTitle = "gallery")
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('DepartmentSiteGalleryBundle:Gallery')->findOneBy(['title' => $galleryTitle]);
        $images = $em->getRepository('DepartmentSiteGalleryBundle:Image')->findBy(['gallery' => $gallery]);

        foreach ($images as &$image) {
            $url = $this->get('itm.file.preview.path.resolver')->getUrl($image, $image->getImage());
            $image->setImage($url);
        }
        return new Response(htmlspecialchars(json_encode($images, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }
}

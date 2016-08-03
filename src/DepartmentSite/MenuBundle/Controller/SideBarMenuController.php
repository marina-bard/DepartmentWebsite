<?php

namespace DepartmentSite\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SideBarMenuController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('DepartmentSiteMenuBundle:SideBarMenu')->findAll();

        foreach($items as &$item) {
            $item->setPhoto($this->get('itm.file.preview.path.resolver')->getUrl($item, $item->getPhoto()));
            var_dump($item->getPhoto());
        }
    }
}

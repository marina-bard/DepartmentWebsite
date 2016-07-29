<?php

namespace DepartmentSite\DefaultBundle\Controller;

use DepartmentSite\ProjectBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DepartmentSite\NewsBundle\DepartmentSiteNewsBundle;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction($_locale)
    {
//        $em = $this->getDoctrine()->getManager();
//        $news_list = $em->getRepository('DepartmentSiteNewsBundle:News')->findBy(array(), array('id'=>'desc'), 5);
//        $adver_list = $em->getRepository('DepartmentSiteAdvertBundle:Notice')->findBy(array(), array('id'=>'desc'), 5);
//        return $this->render('DepartmentSiteDefaultBundle:Default:index.html.twig', array('_locale' => $_locale));
//        $parentComment1 = new Comment();
//        $parentComment1->getParentMaterializedPath();
//        $parentComment1->getRootNode();
//        $parentComment2 = new Comment();
//        $childeComment1 = new Comment();
//        $childeComment2 = new Comment();
//        $grandsonComment1 = new Comment();
//        $parentComment1->setId(1);
//        $parentComment1->setContent('parent comment 1');
//        $parentComment1->setAuthor('father');
//
//        $parentComment2->setId(2);
//        $parentComment2->setContent('parent comment 2');
//        $parentComment2->setAuthor('mother');
//
//        $childeComment1->setId(3);
//        $childeComment1->setContent('child comment 1');
//        $childeComment1->setAuthor('pasha');
//
//        $childeComment2->setContent('childe comment 2');
//        $childeComment2->setAuthor('boris');
//        $childeComment2->setId(4);
//
//        $grandsonComment1->setContent('grandson comment 1');
//        $grandsonComment1->setAuthor('alex');
//        $grandsonComment1->setId(5);
//
//        $childeComment1->setChildNodeOf($parentComment1);
//        $childeComment2->setChildNodeOf($parentComment2);
//        $grandsonComment1->setChildNodeOf($childeComment2);
        $em = $this->getDoctrine()->getManager();
//        $em->persist($parentComment1);
//        $em->persist($parentComment2);
//        $em->persist($childeComment1);
//        $em->persist($childeComment2);
//        $em->persist($grandsonComment1);
//        $em->flush();`
        /**
         * @var Comment $temp
         */
//        $temp->getRealMaterializedPath();
//        $temp->getRealMaterializedPath();
        $root = $em->getRepository('DepartmentSiteProjectBundle:Comment')->find(8);
//        return new Response(var_dump($root->getChildNodes()));
//        $temp = new Comment();
//        $temp->setAuthor('temp');
//        $temp->setContent('temp');
//        $temp->setId(6);
//        $temp->setChildNodeOf($root);
//        $em->persist($root);
//        $em->persist($temp);
//        $em->flush();
//        $s = $em->getRepository('DepartmentSiteProjectBundle:Comment')
//            ->getTree($root->getRealMaterializedPath());
//        $child = $em->getRepository('DepartmentSiteProjectBundle:Comment')->find(6);
//        $root->buildTree(array($child));
        $str = $root->getRealMaterializedPath();
        $pos = strpos($str, '/', 2);
        $newstr = substr($str, 0, $pos);

        $temp = $em->getRepository('DepartmentSiteProjectBundle:Comment')->getTree($newstr);
        return new Response(dump($temp));
    }


    public function pageNotFoundAction($_locale)
    {
        return $this->render('DepartmentSiteDefaultBundle:layout:404.html.twig', array('_locale' => $_locale));
    }
    
     public function getNoticesForMainPageAction()

    {
        $em = $this->getDoctrine()->getManager();
        $notices = $em->getRepository('DepartmentSiteNoticeBundle:Notice')->findBy(array(), array('id'=>'desc'), 6);

        return new Response(htmlspecialchars(json_encode($notices, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function getNewsForMainPageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('DepartmentSiteNewsBundle:News')->findBy(array(), array('id'=>'desc'), 4);

        foreach($news as $oneNews) {
            $oneNews->setPhoto($this->get('itm.file.preview.path.resolver')->getUrl($oneNews, $oneNews->getPhoto()));
        }

        return new Response(htmlspecialchars(json_encode($news, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function getProjectsForMainPageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('DepartmentSiteProjectBundle:Project')->findBy(array(), array('id'=>'desc'), 5);

        return new Response(htmlspecialchars(json_encode($projects, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function getHeaderMenuAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $headerMenu = $em->getRepository('DepartmentSiteMenuBundle:HeaderMenu')->findall();
        return $this->render('@DepartmentSiteDefault/layout/headerMenu.html.twig', array('menu' => $headerMenu,
            '_locale' => $_locale));
    }

    public function getBannerMenuAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $bannerMenu = $em->getRepository('DepartmentSiteMenuBundle:BannerMenu')->findall();
        return $this->render('@DepartmentSiteDefault/layout/bannerMenu.html.twig', array('menu' => $bannerMenu,
            '_locale' => $_locale));
    }

    public function getSidebarMenuAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $sidebarMenu = $em->getRepository('DepartmentSiteMenuBundle:SideBarMenu')->findall();

        foreach($sidebarMenu as &$item) {
            $item->setPhoto($this->get('itm.file.preview.path.resolver')->getUrl($item, $item->getPhoto()));
        }

        return $this->render('@DepartmentSiteDefault/layout/sidebarMenu.html.twig', array('menu' => $sidebarMenu,
            '_locale' => $_locale));
    }
}

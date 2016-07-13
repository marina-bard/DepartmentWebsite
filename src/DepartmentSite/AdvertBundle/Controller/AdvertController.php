<?php
namespace DepartmentSite\AdvertBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DepartmentSite\AdvertBundle\Entity\Advert;
use DepartmentSite\AdvertBundle\Form\AdvertType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Advert controller.
 *
 */
class AdvertController extends Controller
{
    /**
     * Lists all Advert entities.
     *
     */
    public function indexAction($page)
    {
        return $this->render('DepartmentSiteAdvertBundle:Advert:index.html.twig', array('page' => $page));
    }
   
    /**
     * Finds and displays a Advert entity.
     *
     */
    public function showAction(Advert $advert)
    {
        return $this->render('DepartmentSiteAdvertBundle:Advert:show.html.twig', array(
            'advert' => $advert
        ));
    }
    



    public function getAdvertsLengthAction() {
        $sql_request = "SELECT COUNT(*) FROM Advert;";
        $em = $this->getDoctrine()->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($sql_request);
        $statement->execute();
        $temp = $statement->fetchAll()[0]["COUNT(*)"];

        return new Response($temp);
    }

    public function  getAdvertsPaginationAction($page) {
        $sql_request = "SELECT COUNT(*) FROM Advert;";
        $em = $this->getDoctrine()->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($sql_request);
        $statement->execute();
        $temp = $statement->fetchAll()[0]["COUNT(*)"];

        return $this->render('layout/pagination.html.twig', array('listLength' => $temp, 'page' => $page));
    }

    public function getAdvertsAction($page) {
        $adv_per_page = 10;
        $sql_request = "SELECT * FROM Advert ORDER BY createdAt DESC LIMIT " . (($page-1)*$adv_per_page) . ", " . $adv_per_page;
        $em = $this->getDoctrine()->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($sql_request);
        $statement->execute();
        $adverts = $statement->fetchAll();

        $serialized = $this->container->get('serializer')->serialize($adverts, 'json');
        return new Response($serialized);
    }
    

    public function getAllAction() {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findAll();
        return new Response(htmlspecialchars(json_encode($adverts, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

}
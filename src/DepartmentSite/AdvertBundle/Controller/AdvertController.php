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
//        $em = $this->getDoctrine()->getManager();
//        $adverts = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findAll();
        return $this->render('advert/index.html.twig', array('page' => $page));
    }
    /**
     * Creates a new Advert entity.
     *
     */
    public function newAction(Request $request)
    {
        $advert = new Advert();
        $form = $this->createForm('DepartmentSite\AdvertBundle\Form\AdvertType', $advert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();
            return $this->redirectToRoute('advert_show', array('slug' => $advert->getSlug()));
        }
        return $this->render('advert/new.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a Advert entity.
     *
     */
    public function showAction(Advert $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);
        return $this->render('advert/show.html.twig', array(
            'advert' => $advert,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Advert entity.
     *
     */
    public function editAction(Request $request, Advert $advert)
    {
        $deleteForm = $this->createDeleteForm($advert);
        $editForm = $this->createForm('DepartmentSite\AdvertBundle\Form\AdvertType', $advert);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();
            return $this->redirectToRoute('advert_edit', array('slug' => $advert->getSlug()));
        }
        return $this->render('advert/edit.html.twig', array(
            'advert' => $advert,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Advert entity.
     *
     */
    public function deleteAction(Request $request, Advert $advert)
    {
        $form = $this->createDeleteForm($advert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();
        }
        return $this->redirectToRoute('advert_index');
    }
    /**
     * Creates a form to delete a Advert entity.
     *
     * @param Advert $advert The Advert entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Advert $advert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('advert_delete', array('slug' => $advert->getSlug())))
            ->setMethod('DELETE')
            ->getForm()
            ;
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

//    public function getOneAction($id) {
//        $em = $this->getDoctrine()->getManager();
//        $advert = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findOneById($id);
//        return new Response($this->escapeChars(json_encode($advert, JSON_HEX_QUOT | JSON_HEX_TAG)));
//    }
}
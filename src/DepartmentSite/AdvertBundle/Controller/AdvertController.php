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
    public function indexAction()
    {
//        $em = $this->getDoctrine()->getManager();
//        $adverts = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findAll();
        return $this->render('advert/index.html.twig');
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

    public function getAllAction() {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findAll();

        $serialized = $this->container->get('serializer')->serialize($adverts, 'json');
        //$serialized = htmlspecialchars($serialized, ENT_QUOTES, 'UTF-8');
        return new Response($serialized);
        //  return new JsonResponse($news);

    }

    public function getOneAction($id) {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('DepartmentSiteAdvertBundle:Advert')->findOneById($id);
        $serialized = $this->container->get('serializer')->serialize($advert, 'json');
        return new Response($serialized);
    }
}
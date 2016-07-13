<?php

namespace DepartmentSite\SlideShowBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DepartmentSite\SlideShowBundle\Entity\SlideShow;
use DepartmentSite\SlideShowBundle\Form\SlideShowType;

/**
 * SlideShow controller.
 *
 */
class SlideShowController extends Controller
{
    /**
     * Lists all SlideShow entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $slideShows = $em->getRepository('DepartmentSiteSlideShowBundle:SlideShow')->findAll();

//        return $this->render('slideshow/index.html.twig', array(
//            'slideShows' => $slideShows,
//        ));
        return $this->render(':layout:banner.html.twig', array(
            'slideShows' => $slideShows,
        ));
    }

    /**
     * Creates a new SlideShow entity.
     *
     */
    public function newAction(Request $request)
    {
        $slideShow = new SlideShow();
        $form = $this->createForm('DepartmentSite\SlideShowBundle\Form\SlideShowType', $slideShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($slideShow);
            $em->flush();

            return $this->redirectToRoute('slideshow_show', array('id' => $slideShow->getId()));
        }

        return $this->render('slideshow/new.html.twig', array(
            'slideShow' => $slideShow,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SlideShow entity.
     *
     */
    public function showAction(SlideShow $slideShow)
    {
        $deleteForm = $this->createDeleteForm($slideShow);

        return $this->render('slideshow/show.html.twig', array(
            'slideShow' => $slideShow,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SlideShow entity.
     *
     */
    public function editAction(Request $request, SlideShow $slideShow)
    {
        $deleteForm = $this->createDeleteForm($slideShow);
        $editForm = $this->createForm('DepartmentSite\SlideShowBundle\Form\SlideShowType', $slideShow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($slideShow);
            $em->flush();

            return $this->redirectToRoute('slideshow_edit', array('id' => $slideShow->getId()));
        }

        return $this->render('slideshow/edit.html.twig', array(
            'slideShow' => $slideShow,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SlideShow entity.
     *
     */
    public function deleteAction(Request $request, SlideShow $slideShow)
    {
        $form = $this->createDeleteForm($slideShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($slideShow);
            $em->flush();
        }

        return $this->redirectToRoute('slideshow_index');
    }

    /**
     * Creates a form to delete a SlideShow entity.
     *
     * @param SlideShow $slideShow The SlideShow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SlideShow $slideShow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('slideshow_delete', array('id' => $slideShow->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace DepartmentSite\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DepartmentSite\NewsBundle\Entity\News;
use DepartmentSite\NewsBundle\Form\NewsType;
use Symfony\Component\HttpFoundation\Response;

/**
 * News controller.
 *
 * @Route("/news")
 */
class NewsController extends Controller
{
    /**
     * Lists all News entities.
     *
     * @Route("/.{_format}",
     *     defaults = {"_format"="html|json"},
     *     name = "news_index"
     * )
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('DepartmentSiteNewsBundle:News')->findAll();

        $format = $request->getRequestFormat();

        if ($format == 'json') {
            $serialized = $this->container->get('serializer')->serialize($news, $format);
            return new Response($serialized);
        }

        return $this->render('news/index.'.$format.'.twig', array(
            'news' => $news,
            'format' => $format,
        ));
    }

    /**
     * Creates a new News entity.
     *
     * @Route("/new.{_format}",
     *     defaults = {"_format"="html|json"},
     *     name = "news_new"
     * )
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $news = new News();
        $form = $this->createForm('DepartmentSite\NewsBundle\Form\NewsType', $news);
        $form->handleRequest($request);

        $format = $request->getRequestFormat();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            if($format == 'json') {
                $serialized = $this->container->get('serializer')->serialize($news, $format);
                return new Response($serialized);
            }

//            return $this->redirectToRoute('news_show', array(
//                'id' => $news->getId(),
//                'format' => $format,
//                ));
        }

        return $this->render('news/new.html.twig', array(
            'news' => $news,
            'form' => $form->createView(),
            'format' => $format,
        ));
    }

    /**
     * Finds and displays a News entity.
     *
     * @Route("/{id}.{_format}",
     *     defaults = {"_format"="html|json"},
     *     name = "news_show"
     * )
     * @Method("GET")
     */
    public function showAction(Request $request, News $news)
    {
        $format = $request->getRequestFormat();

        $deleteForm = $this->createDeleteForm($news);

        if($format == 'json') {
            $serialized = $this->container->get('serializer')->serialize($news, $format);
            return new Response($serialized);
        }

        return $this->render('news/show.'.$format.'.twig', array(
            'news' => $news,
            'delete_form' => $deleteForm->createView(),
            'format' => $format,
        ));
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     * @Route("/{id}/edit.{_format}",
     *     defaults = {"_format"="html|json"},
     *     name="news_edit"
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, News $news)
    {
        $deleteForm = $this->createDeleteForm($news);
        $editForm = $this->createForm('DepartmentSite\NewsBundle\Form\NewsType', $news);
        $editForm->handleRequest($request);

        $format = $request->getRequestFormat();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            if($format == 'json') {
                $serialized = $this->container->get('serializer')->serialize($news, $format);
                return new Response($serialized);
            }

            return $this->redirectToRoute('news_edit', array(
                'id' => $news->getId(),
                'format' => $format,
            ));
        }

        return $this->render('news/edit.'.$format.'.twig', array(
            'news' => $news,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'format' => $format,
        ));
    }

    /**
     * Deletes a News entity.
     *
     * @Route("/{id}.{_format}",
     *     defaults = {"_format"="html|json"},
     *     name="news_delete"
     * )
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, News $news)
    {
        $form = $this->createDeleteForm($news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($news);
            $em->flush();
        }

        return $this->redirectToRoute('news_index', array(
            'format' => $request->getRequestFormat(),
        ));
    }

    /**
     * Creates a form to delete a News entity.
     *
     * @param News $news The News entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(News $news)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_delete', array(
                'id' => $news->getId(),
                )))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function getAll() {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('DepartmentSiteNewsBundle:News')->findAll();

        $serialized = $this->container->get('serializer')->serialize($news);
        return new Response($serialized);

    }

    public function getOne(Request $request, News $news) {
       // $deleteForm = $this->createDeleteForm($news);

        $serialized = $this->container->get('serializer')->serialize($news);
        return new Response($serialized);
    }
}

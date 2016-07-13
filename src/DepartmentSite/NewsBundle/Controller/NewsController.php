<?php

namespace DepartmentSite\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DepartmentSite\NewsBundle\Entity\News;
use DepartmentSite\NewsBundle\Form\NewsType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use ITM\ImagePreviewBundle\Resolver\PathResolver;


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
     */
    public function indexAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('DepartmentSiteNewsBundle:News')->findAll();

        foreach($news as $oneNews) {
            $url = $this->get('itm.file.preview.path.resolver')->getUrl($oneNews, $oneNews->getPhoto());
            $oneNews->setPhotoUrl($url);
        }
        return $this->render('news/news.html.twig', array(
            'news' => $news,
            '_locale' => $_locale
        ));
    }

    /**
     * Creates a new News entity.
     *
     */
    public function newAction(Request $request)
    {
        $news = new News();
        $form = $this->createForm('DepartmentSite\NewsBundle\Form\NewsType', $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

//            return $this->redirectToRoute('news_show', array(
//                'id' => $news->getId(),
//                'format' => $format,
//                ));
        }

        return $this->render('news/new.html.twig', array(
            'news' => $news,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a News entity.
     *
     *     defaults = {"_format"="html|json"},
     */
    public function showAction(Request $request, News $news, $_locale)
    {
        $deleteForm = $this->createDeleteForm($news);

//        $resolver = new PathResolver(null);
//        $url = $resolver->getUrl($news, $news->getPhoto());

        return $this->render('news/show.html.twig', array(
//            'url' => $url,
            'news' => $news,
            'delete_form' => $deleteForm->createView(),
            '_locale' => $_locale
        ));
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     */
    public function editAction(Request $request, News $news)
    {
        $deleteForm = $this->createDeleteForm($news);
        $editForm = $this->createForm('DepartmentSite\NewsBundle\Form\NewsType', $news);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('news_edit', array(
                'slug' => $news->getSlug(),
            ));
        }

        return $this->render('news/edit.html.twig', array(
            'news' => $news,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a News entity.
     *
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

        return $this->redirectToRoute('news_index');
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
                'slug' => $news->getSlug(),
                )))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

//    public function escapeChars($value)
//    {
//        $escaper = array("\"");
//        $replacements = array("\\\\");
//        $result = str_replace($escaper, $replacements, $value);
//        return $result;
//    }

    public function getAllAction() {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('DepartmentSiteNewsBundle:News')->findAll();
        return new Response(htmlspecialchars(json_encode($news, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

}

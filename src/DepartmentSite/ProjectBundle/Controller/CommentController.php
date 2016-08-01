<?php

namespace DepartmentSite\ProjectBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use DepartmentSite\ProjectBundle\Entity\Comment;
use DepartmentSite\ProjectBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{
    /**
     * Creates a new Comment entity.
     *
     * @Route(
     *     "/{_locale}/comment/new",
     *      name="comment_new",
     *     )
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $_locale)
    {
        $content = $request->get("content");
        $projectId = $request->get("projectId");
        $commentId = $request->get("commentId");

        $childComment = new Comment();
        $childComment->setContent($content);
        $childComment->setAuthor('author');
        $em = $this->getDoctrine()->getManager();

        if($commentId == -1)
        {
            $project = $em->getRepository('DepartmentSiteProjectBundle:Project')
                ->find($projectId);
            $childComment->setProject($project);
            $em->persist($childComment);
            $em->flush();
        }
        else {
            $parentComment = $em->getRepository('DepartmentSiteProjectBundle:Comment')
                ->find($commentId);
            $childComment->setId(1);
            $childComment->setChildNodeOf($parentComment);
            $em->persist($childComment);
            $em->flush();
            $rootComment = $em->getRepository('DepartmentSiteProjectBundle:Comment')
                ->getTree($childComment->getRootMaterializedPath());
        }
            return new Response("Ваш комментарий будет опубликован после модерации.");
    }

    /**
     * Finds and displays a Comment entity.
     *
     * @Route(
     *     "/{_locale}/comment/{id}/show",
     *      name="comment_show",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET"})
     * @Template
     */
    public function showAction(Comment $comment, $_locale)
    {
        $deleteForm = $this->createDeleteForm($comment);

        return $this->render('comment/show.html.twig', array(
            'comment' => $comment,
            'delete_form' => $deleteForm->createView(),
            '_locale' => $_locale
        ));
    }
    
    /**
     * Deletes a Comment entity.
     *
     * @Route(
     *     "/{_locale}/comment/{id}/delete",
     *      name="comment_delete",
     *     )
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, Comment $comment)
    {
        $form = $this->createDeleteForm($comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('comment_index');
    }

    /**
     * Creates a form to delete a Comment entity.
     *
     * @param Comment $comment The Comment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comment $comment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $comment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

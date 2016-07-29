<?php

namespace DepartmentSite\ProjectBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use DepartmentSite\ProjectBundle\Entity\Comment;
use DepartmentSite\ProjectBundle\Form\CommentType;


/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{
    /**
     * Lists all Comment entities.
     *
     */
    public function indexAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('DepartmentSiteProjectBundle:Comment')->findAll();

        return $this->render('comment/index.html.twig', array(
            'comments' => $comments, '_locale' => $_locale
        ));
    }

    /**
     * Creates a new Comment entity.
     *
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
            return new Response("Ваш комментарий будет опубликован после модерации.");

        }
        else
        {
            $parentComment = $em->getRepository('DepartmentSiteProjectBundle:Comment')
                ->find($commentId);
//            $childComment->buildTree(array($parentComment));
            $childComment->setId(1);
            $childComment->setChildNodeOf($parentComment);
            $em->persist($childComment);
            $em->flush();
//            $realMaterializedPathChildNode = $childComment->getRealMaterializedPath();
//            $pos = strpos($realMaterializedPathChildNode, '/', 2);
//            $realMaterializedPathRootNode = substr($realMaterializedPathChildNode, 0, $pos);
            $rootComment = $em->getRepository('DepartmentSiteProjectBundle:Comment')
                ->getTree($childComment->getRootNode()->getNodeId());
            dump($rootComment);
            die();
            return new Response($rootComment);
        }


//        return new \Symfony\Component\HttpFoundation\Response($commentId);

//        $form = $this->createForm('DepartmentSite\ProjectBundle\Form\CommentType', $comment);
//        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($comment);
//            $em->flush();
//
//            return $this->redirectToRoute('comment_show', array('id' => $comment->getId(), '_locale' => $_locale));
//        }



//        return $this->render('comment/new.html.twig', array(
//            'comment' => $comment,
//            'form' => $form->createView(),
//            '_locale' => $_locale
//        ));
    }

    /**
     * Finds and displays a Comment entity.
     *
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
     * Displays a form to edit an existing Comment entity.
     *
     */
    public function editAction(Request $request, Comment $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);
        $editForm = $this->createForm('DepartmentSite\ProjectBundle\Form\CommentType', $comment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('comment_edit', array('id' => $comment->getId()));
        }

        return $this->render('comment/edit.html.twig', array(
            'comment' => $comment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Comment entity.
     *
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

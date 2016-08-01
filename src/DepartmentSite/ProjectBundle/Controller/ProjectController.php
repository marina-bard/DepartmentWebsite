<?php

namespace DepartmentSite\ProjectBundle\Controller;

use DepartmentSite\ProjectBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DepartmentSite\ProjectBundle\Entity\Project;
use DepartmentSite\ProjectBundle\Form\ProjectType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Project controller.
 *
 */
class ProjectController extends Controller
{

    const PROJECTS_COUNT = 10;
    /**
     * Lists all Project entities.
     *
     */
    public function indexAction($_locale, $page)
    {
        $request = new Request();
        $projects = $this->getProjects();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $projects,
            $request->query->get('page', $page),
            self::PROJECTS_COUNT
        );
        $projects = (Object)$pagination->getItems();

        return $this->render('DepartmentSiteProjectBundle:Project:index.html.twig', array(
            'projects' => $projects,
            '_locale' => $_locale,
            'pagination' => $pagination
        ));
    }

    public function getProjects(){
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteProjectBundle:Project');

        $query = $repository->createQueryBuilder('a')
            ->select()
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery();

        return $query->getResult();
    }



    /**
     * Creates a new Project entity.
     *
     */
    public function newAction(Request $request, $_locale)
    {
        $project = new Project();
        $form = $this->createForm('DepartmentSite\ProjectBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_show', array('slug' => $project->getSlug(), '_locale' => $_locale));
        }

        return $this->render('DepartmentSiteProjectBundle:Project:new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
            '_locale' => $_locale
        ));
    }

    /**
     * Finds and displays a Project entity.
     *
     */
    public function showAction(Project $project, $_locale, $slug)
    {
        $deleteForm = $this->createDeleteForm($project);

        return $this->render('DepartmentSiteProjectBundle:Project:show.html.twig', array(
            'project' => $project,
            'delete_form' => $deleteForm->createView(),
            '_locale' => $_locale
        ));
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     */
    public function editAction(Request $request, Project $project, $_locale)
    {
        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('DepartmentSite\ProjectBundle\Form\ProjectType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_edit', array('slug' => $project->getSlug()));
        }

        return $this->render('DepartmentSiteProjectBundle:Project:edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            '_locale' => $_locale
        ));
    }

    /**
     * Deletes a Project entity.
     *
     */
    public function deleteAction(Request $request, Project $project, $_locale)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('project_index', array(
            '_locale' => $_locale
        ));
    }

    /**
     * Creates a form to delete a Project entity.
     *
     * @param Project $project The Project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('slug' => $project->getSlug())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function getAllAction($pagination)
    {
        $projects = (Object)$pagination->getItems();
        return new JsonResponse($projects);
    }

    public function getOneAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('DepartmentSiteProjectBundle:Project')->findOneBy(array('slug' => $slug));
//        $comment = new Comment();
        return new Response(htmlspecialchars(json_encode($project, JSON_HEX_QUOT | JSON_HEX_TAG)));
//        return $this->render('@DepartmentSiteProject/Project/show.html.twig', array(
//            htmlspecialchars(json_encode($project, JSON_HEX_QUOT | JSON_HEX_TAG)),
//            'comment' => $comment,
//            'locale' => $locale
//            ));
    }
    public function getCommentsByProjectIdAction($projectId)
    {
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteProjectBundle:Comment');

        $query = $repository->createQueryBuilder('a')
            ->select('a')
            ->where('a.project = :projectId')
            ->setParameter('projectId', $projectId)
            ->getQuery();
//        $em = $this->getDoctrine()->getManager();
//        $project = $em->getRepository('DepartmentSiteProjectBundle:Project')->find($projectId);
//        $comments = $project->getComments();
//        return new  Response(var_dump($comments));
//        return new  Response(json_encode($project->getCommentsCount(), JSON_HEX_QUOT | JSON_HEX_TAG));

        return new Response(json_encode($query->getArrayResult(), JSON_HEX_QUOT | JSON_HEX_TAG));
    }

    public function getCommentsCountAction($projectId){
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteProjectBundle:Comment');

        $query = $repository->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->where('a.project = :projectId')
            ->setParameter('projectId', $projectId)
            ->getQuery();
        return new Response($query->getSingleScalarResult());
    }
}

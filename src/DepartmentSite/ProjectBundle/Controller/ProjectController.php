<?php

namespace DepartmentSite\ProjectBundle\Controller;

use DepartmentSite\ProjectBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Route(
     *     "{_locale}/project/",
     *      name="project_index",
     *      defaults={"_locale": "ru", "page" : "1"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET"})
     * @Template
     */
    public function indexAction($_locale, $page)
    {
        $request = new Request();
        $projects = $this->getDoctrine()
            ->getRepository('DepartmentSiteProjectBundle:Project')
            ->findBy(['isModerated' => true], ['createdAt' => 'DESC']);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $projects,
            $request->query->get('page', $page),
            self::PROJECTS_COUNT
        );
        $projects = (Object)$pagination->getItems();

        return array(
            'projects' => $projects,
            '_locale' => $_locale,
            'pagination' => $pagination
        );
    }

    /**
     * Creates a new Project entity.
     *
     * @Route(
     *     "{_locale}/project/new",
     *      name="project_new",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET", "POST"})
     * @Template
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

        return array(
            'project' => $project,
            'form' => $form->createView(),
            '_locale' => $_locale
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route(
     *     "{_locale}/project/{slug}/show",
     *      name="project_show",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET"})
     * @Template
     */
    public function showAction(Project $project, $_locale, $slug)
    {
        $deleteForm = $this->createDeleteForm($project);

        return array(
            'project' => $project,
            'delete_form' => $deleteForm->createView(),
            '_locale' => $_locale
        );
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route(
     *     "{_locale}/project/{slug}/edit",
     *      name="project_edit",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET", "POST"})
     * @Template
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

        return array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            '_locale' => $_locale,
            'slug' => $project->getSlug()
        );
    }

    /**
     * Deletes a Project entity.
     * @Route(
     *     "{_locale}/project/{slug}/delete",
     *      name="project_delete",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"DELETE"})
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
        return new Response(htmlspecialchars((json_encode($projects, JSON_HEX_QUOT | JSON_HEX_TAG))));
    }

    public function getOneAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('DepartmentSiteProjectBundle:Project')->findOneBy(array('slug' => $slug));
        return new Response(htmlspecialchars(json_encode($project, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function getCommentsByProjectIdAction($projectId)
    {
        $em = $this->getDoctrine()->getManager();
        $trees = $em->getRepository('DepartmentSiteProjectBundle:Comment')->getRootNodes();
        $rootProjectComments = array();
        foreach ($trees as $tree) {

            if ($tree->getProject()->getId() == $projectId)
            {
                array_push($rootProjectComments,
                    $em->getRepository('DepartmentSiteProjectBundle:Comment')
                        ->getTree($tree->getRealMaterializedPath()));
            }
        }
        return new Response(htmlspecialchars(json_encode($rootProjectComments, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function recursiveCount($tree, &$count)
    {
        if($tree->getChildNodes())
        {
            foreach ($tree->getChildNodes() as $node)
                $this->recursiveCount($node, $count);
        }
        return $count++;
    }

    public function getCommentsCountAction($projectId)
    {
        $em = $this->getDoctrine()->getManager();
        $trees = $em->getRepository('DepartmentSiteProjectBundle:Comment')->getRootNodes();
        $count = 0;
        foreach ($trees as $tree) {
            if ($tree->getProject()->getId() == $projectId)
            {
                $this->recursiveCount( $em->getRepository('DepartmentSiteProjectBundle:Comment')
                        ->getTree($tree->getRealMaterializedPath()), $count);
            }
        }
        return new Response(htmlspecialchars(json_encode($count, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }
}

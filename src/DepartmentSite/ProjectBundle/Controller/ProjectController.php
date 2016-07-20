<?php

namespace DepartmentSite\ProjectBundle\Controller;

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
    /**
     * Lists all Project entities.
     *
     */
    public function indexAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('DepartmentSiteProjectBundle:Project')->findAll();

        return $this->render('DepartmentSiteProjectBundle:Project:index.html.twig', array(
            'projects' => $projects,  '_locale' => $_locale
        ));
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

            return $this->redirectToRoute('project_show', array('slug' => $project->getSlug()));
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
    public function showAction(Project $project, $_locale)
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
    public function deleteAction(Request $request, Project $project)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('project_index');
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

    public function getAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('DepartmentSiteProjectBundle:Project')->findAll();

        return new Response(htmlspecialchars(json_encode($projects, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }

    public function getOneAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('DepartmentSiteProjectBundle:Project')->findOneBy(array('slug' => $slug));

        return new Response(htmlspecialchars(json_encode($project, JSON_HEX_QUOT | JSON_HEX_TAG)));
    }
}

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
    /**
     * Lists all Project entities.
     *
     * @Route(
     *     "{_locale}/project/",
     *      name="project_index",
     *      defaults={"_locale": "ru"},
     *      requirements = {"_locale" = "ru|en"},
     *     )
     * @Method({"GET"})
     * @Template
     */
    public function indexAction($_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('DepartmentSiteProjectBundle:Project')->findAll();
        return array('projects' => $projects,  '_locale' => $_locale);
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
            '_locale' => $_locale,
            'slug' => $project->getSlug()
        ));
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
    public function getCommentsByProjectIdAction($projectId)
    {
        $repository = $this->getDoctrine()
            ->getRepository('DepartmentSiteProjectBundle:Comment');

        $query = $repository->createQueryBuilder('a')
            ->select('a')
            ->where('a.project = :projectId')
            ->setParameter('projectId', $projectId)
            ->getQuery();

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

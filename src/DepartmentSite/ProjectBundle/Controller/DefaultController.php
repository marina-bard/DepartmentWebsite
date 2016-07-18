<?php

namespace DepartmentSite\ProjectBundle\Controller;

use DepartmentSite\ProjectBundle\Entity\Comment;
use DepartmentSite\ProjectBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        $em = $this->getDoctrine()->getManager()->getRepository('DepartmentSiteProjectBundle:Comment');

//        $project = $em->findAll()[0]->getProject();

//        $commentParent = new Comment();
//        $commentParent->setId(0);
//        $commentParent->setContent('parent');
//
//        $commentChild = new Comment();
//        $commentChild->setId(1);
//        $commentChild->setContent('child');
//
//        $commentChild->setChildNodeOf($commentParent);
//
//
//        $project = new Project();
//        $project->setContent('qw');
//        $project->setTitle('qe');
//        $project->setCourse(12);
//        $project->setDescription('qwe');
//        $project->setIsModerated(true);
//        $project->setEndDate(new \DateTime());
//        $project->setStartDate(new \DateTime());
//        $project->setReviewer('qwer');
//        $project->setStudent('qwert');
//        $project->setStudentGroup('wadsfd');
//        $project->setTeacher('afggr');
//
//        $project->addComment($commentParent);
//        $commentParent->setProject($project);
//
//        $em->persist($commentParent);
//        $em->persist($commentChild);
//        $em->persist($project);
//
//        $em->flush();

//        return new Response(var_dump($project));
        return $this->render('DepartmentSiteProjectBundle:Default:index.html.twig');
    }
}

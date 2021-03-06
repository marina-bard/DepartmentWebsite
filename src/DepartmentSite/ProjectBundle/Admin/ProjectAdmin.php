<?php

namespace DepartmentSite\ProjectBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjectAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('student', 'text', array('label' => 'Student'))
            ->add('teacher', 'text', array('label' => 'Teacher'))
            ->add('course', 'number', array('label' => 'Course'))
            ->add('studentGroup', 'text', array('label' => 'studentGroup'))
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('description', TextareaType::class, array('label' => 'description'))
            ->add('content', CKEditorType::class, array('label' => 'Content'))
            ->add('comments', 'sonata_type_collection', array('by_reference' => false, 'required' => false), array(
                'edit' => 'inline',
                'inline' => 'table',
            ))

            ->add('teacher_comment', 'textarea', array('label'=> 'Teacher review', 'required' => false));

        if($this->isCurrentRoute('edit')){
            $formMapper
                ->add('teacher_comment', 'textarea', array('label' => 'Teacher review'));
        }
        $formMapper
            ->add('isModerated', 'checkbox', array(
                'required' => false
            ));


    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title');

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array())));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('student')
            ->add('teacher')
            ->add('course')
            ->add('studentGroup')
            ->add('startDate')
            ->add('endDate')
            ->add('description')
            ->add('content', 'html')
            ->add('comments')
            ->add('isModerated')
        ;
    }

    public function prePersist($project)
    {
        $project->setComments($project->getComments());
    }

    public function preUpdate($project)
    {
        $project->setComments($project->getComments());
        $em = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $trees = $em->getRepository('DepartmentSiteProjectBundle:Comment')->getRootNodes();
        $rootProjectComments = array();
        foreach ($trees as $tree) {

            if ($tree->getProject()->getId() == $project->getId() && $tree->getIsModerated())
            {
                array_push($rootProjectComments,
                    $em->getRepository('DepartmentSiteProjectBundle:Comment')
                        ->getTree($tree->getRealMaterializedPath()));
            }
        }
        $project->setCountComment(count($rootProjectComments));
    }


}

<?php
/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DepartmentSite\ProjectBundle\Controller;

use DepartmentSite\ProjectBundle\Entity\Comment;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Page Admin Controller.
 *
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class CommentAdminController extends Controller
{


    /**
     * @param Request $request
     *
     * @Route(
     *     "/list-tree",
     *     name="admin.comment.tree"
     * )
     *
     * @return Response
     */
    public function treeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rootNodes = $em->getRepository('DepartmentSiteProjectBundle:Comment')->getRootNodes();
        $rootComments = [];
        foreach ($rootNodes as $rootNode)
        {
            array_push($rootComments, $em->getRepository('DepartmentSiteProjectBundle:Comment')
                ->getTree($rootNode->getRealMaterializedPath())
                );
        }

        return $this->render('@DepartmentSiteProject/ProjectAdmin/tree.html.twig', array(
            'action' => 'tree',
            'treeArray' => $rootComments));

//        $comment = $em->getRepository('')
//
//        $categoryManager = $this->get('sonata.classification.manager.category');
//        $currentContext = false;
//        if ($context = $request->get('context')) {
//            $currentContext = $this->get('sonata.classification.manager.context')->find($context);
//        }
//        $rootCategories = $categoryManager->getRootCategories(false);
//        if (!$currentContext) {
//            $mainCategory = current($rootCategories);
//            $currentContext = $mainCategory->getContext();
//        } else {
//            foreach ($rootCategories as $category) {
//                if ($currentContext->getId() != $category->getContext()->getId()) {
//                    continue;
//                }
//                $mainCategory = $category;
//                break;
//            }
//        }
//        $datagrid = $this->admin->getDatagrid();
//        if ($this->admin->getPersistentParameter('context')) {
//            $datagrid->setValue('context', ChoiceType::TYPE_EQUAL, $this->admin->getPersistentParameter('context'));
//        }
//        $formView = $datagrid->getForm()->createView();
//        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());
//        return $this->render('@DepartmentSiteProject/ProjectAdmin/tree.html.twig', array(
//            'action' => 'tree',
//            'main_category' => $mainCategory,
//            'root_categories' => $rootCategories,
//            'current_context' => $currentContext,
//            'form' => $formView,
//            'csrf_token' => $this->getCsrfToken('sonata.batch'),
//        ));
    }
}
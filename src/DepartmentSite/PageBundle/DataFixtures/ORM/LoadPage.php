<?php

/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 26.7.16
 * Time: 21.59
 */
namespace DepartmentSite\PageBundle\DataFixtures\ORM;

use DepartmentSite\PageBundle\Entity\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPage implements FixtureInterface
{
    private function createPage(ObjectManager &$manager, $ru_title, $en_title, $ru_content, $en_content )
    {
        $page = new Page();
        $page->translate('ru')->setTitle($ru_title);
        $page->translate('en')->setTitle($en_title);
        $page->translate('ru')->setContent($ru_content);
        $page->translate('en')->setContent($en_content);
        $page->setTitle($page->translate('en')->getTitle());
        $manager->persist($page);
        $page->mergeNewTranslations();
    }

    public function load(ObjectManager $manager)
    {
        $this->createPage($manager, 'Студентам', 'For students', 'Содержимое студентам', 'Content for students');
        $this->createPage($manager, 'Абитуриентам', 'For applicants', 'Содержимое абитуриентам', 'Content for application');
        $this->createPage($manager, 'Дипломникам', 'For graduate', 'Содержимое дипломникам', 'Content for graduate' );
        $this->createPage($manager, 'Родителям', 'For parents', 'Содержимое родителям', 'Content for parents' );
        
        $manager->flush();
    }
}
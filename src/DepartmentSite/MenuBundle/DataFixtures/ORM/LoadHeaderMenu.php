<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 22.6.16
 * Time: 15.09
 */

namespace DepartmentSite\MenuBundle\DataFixtures\ORM;

use DepartmentSite\MenuBundle\Entity\HeaderMenu;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadHeaderMenu implements FixtureInterface
{
    private function createHeaderMenu(ObjectManager &$manager, $ru_value, $en_value )
    {
        $headerMenu = new HeaderMenu();
        $headerMenu->translate('ru')->setTitle($ru_value);
        $headerMenu->translate('en')->setTitle($en_value);
        $headerMenu->setTitle($headerMenu->translate('en')->getTitle());
        $manager->persist($headerMenu);
        $headerMenu->mergeNewTranslations();
    }

    public function load(ObjectManager $manager)
    {
        $this->createHeaderMenu($manager, 'About department', 'About department');
        $this->createHeaderMenu($manager, 'Department structure', 'Структура кафедры');
        $this->createHeaderMenu($manager, 'Education', 'Образование');
        $this->createHeaderMenu($manager, 'Feedback', 'Обратная связь');

        $manager->flush();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 22.6.16
 * Time: 15.08
 */

namespace DepartmentSite\MenuBundle\DataFixtures\ORM;

use DepartmentSite\MenuBundle\Entity\BannerMenu;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBannerMenu implements FixtureInterface
{
    private function createBannerMenu(ObjectManager &$manager, $ru_value, $en_value )
    {
        $bannerMenu = new BannerMenu();
        $bannerMenu->translate('ru')->setTitle($ru_value);
        $bannerMenu->translate('en')->setTitle($en_value);
        $bannerMenu->setTitle($bannerMenu->translate('en')->getTitle());
        $manager->persist($bannerMenu);
        $bannerMenu->mergeNewTranslations();
    }

    public function load(ObjectManager $manager)
    {
        $this->createBannerMenu($manager, 'For students', 'Студентам');
        $this->createBannerMenu($manager, 'For applicants', 'Абитуриентам');
        $this->createBannerMenu($manager, 'For graduate', 'Дипломникам');
        $this->createBannerMenu($manager, 'For parents', 'Родителям');

        $manager->flush();
    }
}
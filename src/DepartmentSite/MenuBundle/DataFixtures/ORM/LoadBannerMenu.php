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
        $this->createBannerMenu($manager, 'Студентам', 'For students' );
        $this->createBannerMenu($manager, 'Абитуриентам', 'For applicants');
        $this->createBannerMenu($manager, 'Дипломникам', 'For graduate' );
        $this->createBannerMenu($manager, 'Родителям', 'For parents');

        $manager->flush();
    }
}
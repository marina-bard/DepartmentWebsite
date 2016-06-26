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
    public function load(ObjectManager $manager)
    {
        $bannerMenu1 = new BannerMenu();
        $bannerMenu1->setTitle('Студентам');
        $manager->persist($bannerMenu1);

        $bannerMenu2 = new BannerMenu();
        $bannerMenu2->setTitle('Абитуриентам');
        $manager->persist($bannerMenu2);
        
        $bannerMenu3 = new BannerMenu();
        $bannerMenu3->setTitle('Дипломникам');
        $manager->persist($bannerMenu3);
        
        $bannerMenu4 = new BannerMenu();
        $bannerMenu4->setTitle('Родителям');
        $manager->persist($bannerMenu4);

        $manager->flush();
    }
}
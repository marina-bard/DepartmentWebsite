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
        $bannerMenu1->translate('en')->setTitle('For students');
        $bannerMenu1->translate('ru')->setTitle('Студентам');
        $bannerMenu1->setTitle($bannerMenu1->translate('en')->getTitle());
        $manager->persist($bannerMenu1);
        $bannerMenu1->mergeNewTranslations();

        $bannerMenu2 = new BannerMenu();
        $bannerMenu2->translate('en')->setTitle('For applicants');
        $bannerMenu2->translate('ru')->setTitle('Абитуриентам');
        $bannerMenu2->setTitle($bannerMenu2->translate('en')->getTitle());
        $manager->persist($bannerMenu2);
        $bannerMenu2->mergeNewTranslations();


        $bannerMenu3 = new BannerMenu();
        $bannerMenu3->translate('en')->setTitle('To graduate');
        $bannerMenu3->translate('ru')->setTitle('Дипломникам');
        $bannerMenu3->setTitle($bannerMenu3->translate('en')->getTitle());
        $manager->persist($bannerMenu3);
        $bannerMenu3->mergeNewTranslations();

        $bannerMenu4 = new BannerMenu();
        $bannerMenu4->translate('en')->setTitle('To parents');
        $bannerMenu4->translate('ru')->setTitle('Родителям');
        $bannerMenu4->setTitle($bannerMenu4->translate('en')->getTitle());
        $manager->persist($bannerMenu4);
        $bannerMenu4->mergeNewTranslations();

        $manager->flush();
    }
}
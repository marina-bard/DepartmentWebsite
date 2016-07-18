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
    public function load(ObjectManager $manager)
    {
        $headerMenu1 = new HeaderMenu();
        $headerMenu1->translate('en')->setTitle('About department');
        $headerMenu1->translate('ru')->setTitle('О кафедре');
        $headerMenu1->setTitle($headerMenu1->translate('en')->getTitle());
        $manager->persist($headerMenu1);
        $headerMenu1->mergeNewTranslations();

        $headerMenu2 = new HeaderMenu();
        $headerMenu2->translate('en')->setTitle('Department structure');
        $headerMenu2->translate('ru')->setTitle('Структура кафедры');
        $headerMenu2->setTitle($headerMenu2->translate('en')->getTitle());
        $manager->persist($headerMenu2);
        $headerMenu2->mergeNewTranslations();

        $headerMenu3 = new HeaderMenu();
        $headerMenu3->translate('en')->setTitle('Education');
        $headerMenu3->translate('ru')->setTitle('Образование');
        $headerMenu3->setTitle($headerMenu3->translate('en')->getTitle());
        $manager->persist($headerMenu3);
        $headerMenu3->mergeNewTranslations();

        $headerMenu4 = new HeaderMenu();
        $headerMenu4->translate('en')->setTitle('Feedback');
        $headerMenu4->translate('ru')->setTitle('Обратная связь');
        $headerMenu4->setTitle($headerMenu4->translate('en')->getTitle());
        $manager->persist($headerMenu4);
        $headerMenu4->mergeNewTranslations();

//        $headerMenu5 = new HeaderMenu();
//        $headerMenu5->translate('en')->setTitle('Registration | Log in');
//        $headerMenu5->translate('ru')->setTitle('Регистрация | Войти');
//        $headerMenu5->setTitle($headerMenu5->translate('en')->getTitle());
//        $manager->persist($headerMenu5);
//        $headerMenu5->mergeNewTranslations();

        $manager->flush();
    }
}
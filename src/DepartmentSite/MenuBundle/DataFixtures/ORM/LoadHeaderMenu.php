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
        $headerMenu1->setTitle('О кафедре');
        $manager->persist($headerMenu1);

        $headerMenu2 = new HeaderMenu();
        $headerMenu2->setTitle('Структура кафедры');
        $manager->persist($headerMenu2);

        $headerMenu3 = new HeaderMenu();
        $headerMenu3->setTitle('Образование');
        $manager->persist($headerMenu3);

        $headerMenu4 = new HeaderMenu();
        $headerMenu4->setTitle('Обратная связь');
        $manager->persist($headerMenu4);

        $headerMenu5 = new HeaderMenu();
        $headerMenu5->setTitle('Регистрация | Войти');
        $manager->persist($headerMenu5);

        $manager->flush();
    }
}
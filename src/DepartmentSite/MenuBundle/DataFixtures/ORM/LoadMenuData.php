<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 21.6.16
 * Time: 13.01
 */

namespace DepartmentSite\MenuBundle\DataFixtures\ORM;

use DepartmentSite\MenuBundle\Entity\Menu;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMenuData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $menu1 = new Menu();
        $menu1->setTitle('О кафедре');
        $menu1->setUrl('https://new.vk.com/id30329553');
        $manager->persist($menu1);

        $menu2 = new Menu();
        $menu2->setTitle('Структура кафедры');
        $menu2->setUrl('https://www.instagram.com/marina.bard/');
        $manager->persist($menu2);

        $menu3 = new Menu();
        $menu3->setTitle('Образование');
        $menu3->setUrl('https://new.vk.com/kozlova_oxana');
        $manager->persist($menu3);

        $menu4 = new Menu();
        $menu4->setTitle('Обратная связь');
        $menu4->setUrl('https://new.vk.com/artvlad96');
        $manager->persist($menu4);

        $menu5 = new Menu();
        $menu5->setTitle('Регистрация | Войти');
        $menu5->setUrl('https://new.vk.com/hello_i_am_here');
        $manager->persist($menu5);

        $menu6 = new Menu();
        $menu6->setTitle('Студентам');
        $menu6->setUrl('https://www.google.by');
        $manager->persist($menu6);

        $menu7 = new Menu();
        $menu7->setTitle('Абитуриентам');
        $menu7->setUrl('http://www.tut.by/');
        $manager->persist($menu7);

        $menu8 = new Menu();
        $menu8->setTitle('Дипломникам');
        $menu8->setUrl('https://habrahabr.ru/company/webnames/blog/149106/');
        $manager->persist($menu8);

        $menu9 = new Menu();
        $menu9->setTitle('Родителям');
        $menu9->setUrl('http://4stor.ru/smertelnie-faili/49319-top-samyh-strashnyh-saytov.html');
        $manager->persist($menu9);
        $manager->flush();
    }
}
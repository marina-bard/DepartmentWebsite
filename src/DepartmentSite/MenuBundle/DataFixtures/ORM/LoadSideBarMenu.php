<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 17.7.16
 * Time: 20.45
 */

namespace DepartmentSite\MenuBundle\DataFixtures\ORM;

use DepartmentSite\MenuBundle\Entity\SideBarMenu;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSideBarMenu implements FixtureInterface
{
    private function createMenu(ObjectManager &$manager, $ru_value, $en_value, $link, $photo_url)
    {
        $menu = new SideBarMenu();
        $menu->translate('en')->setTitle($en_value);
        $menu->translate('ru')->setTitle($ru_value);
        $menu->setTitle($en_value);
        $menu->setValue($link);
        $menu->setPhoto($photo_url);
        $manager->persist($menu);
        $menu->mergeNewTranslations();
    }

    public function load(ObjectManager $manager)
    {
        $this->createMenu($manager, 'Bit-Cup 2016', 'BitCup 2016', 'bit-cup', '941e816f92e3894f7513d5d482d6248dc8085642.jpeg');
        $this->createMenu($manager, 'Online-курсы', 'Online-courses', 'online-courses', '941e816f92e3894f7513d5d482d6248dc8085642.jpeg');
        $this->createMenu($manager, 'Фотогалерея', 'gallery', 'gallery', '941e816f92e3894f7513d5d482d6248dc8085642.jpeg');
        $this->createMenu($manager, 'Олимпиады и  конкурсы по программированию', 'Olympiads', 'olympiads', '941e816f92e3894f7513d5d482d6248dc8085642.jpeg');

        $manager->flush();
    }
}
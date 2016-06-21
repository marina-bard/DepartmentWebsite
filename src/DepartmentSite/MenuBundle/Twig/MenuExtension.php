<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 21.6.16
 * Time: 13.37
 */

namespace DepartmentSite\MenuBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class MenuExtension extends \Twig_Extension
{
    use ContainerAwareTrait;

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('MENU', array($this,'menuFilter') ),
        );
    }

    public function menuFilter($title)
    {
        $menu = $this->container
            ->get('doctrine')
            ->getManager()
            ->getRepository('DepartmentSiteMenuBundle:Menu')
            ->findOneBy(array('title' => $title));

        return $menu->getUrl();
    }

    public function getName()
    {
        return 'menu_extension';
    }
}
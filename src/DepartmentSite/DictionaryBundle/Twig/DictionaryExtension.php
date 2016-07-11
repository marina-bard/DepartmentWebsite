<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 16.6.16
 * Time: 15.50
 */

namespace DepartmentSite\DictionaryBundle\Twig;


use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class DictionaryExtension extends \Twig_Extension
{
    use ContainerAwareTrait;

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('DICTIONARY', array($this,'dictionaryFilter') ),
        );
    }

    public function dictionaryFilter($code)
    {
        $dictionary = $this->container
            ->get('doctrine')
            ->getManager()
            ->getRepository('DepartmentSiteDictionaryBundle:Dictionary')
            ->findOneBy(array('code' => $code));

        return $dictionary->getValue();

//      throw new \InvalidArgumentException('Code is undefined');
    }

    public function getName()
    {
        return 'dictionary_extension';
    }
}
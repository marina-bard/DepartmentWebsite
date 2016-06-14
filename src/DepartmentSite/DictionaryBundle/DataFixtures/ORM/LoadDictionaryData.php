<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14.6.16
 * Time: 15.08
 */

namespace DepartmentSite\DictionaryBundle\DataFixtures\DataFixtures\ORM;

use DepartmentSite\DictionaryBundle\Entity\Dictionary;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDictionaryData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $dictionary = new Dictionary();
        $tempDictionary = array(
            'vkLink' => '',
            'facebookLink' => '',
            'twiterLink' => '',
            'instagramLink' => '',
            'phone' => '',
            'address' => ''
        );
        $dictionary->setDictionary($tempDictionary);
        $manager->persist($dictionary);
        $manager->flush();
    }
    // Warning: unlink(/tmp/127-0-0-1-8000.pid): Operation not permitted 
}
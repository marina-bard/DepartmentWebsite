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
        $dictionary1 = new Dictionary();
        $dictionary1->setCode('VK_Link');
        $dictionary1->setTitle('Link to "VK" social network');
        $dictionary1->setValue('https://new.vk.com/lysenkov96');
        $manager->persist($dictionary1);
        
        $dictionary2 = new Dictionary();
        $dictionary2->setCode('facebook_Link');
        $dictionary2->setTitle('Link to "facebook" social network');
        $dictionary2->setValue('https://www.facebook.com/groups/vmsis/?fref=nf');
        $manager->persist($dictionary2);
        
        $dictionary3 = new Dictionary();
        $dictionary3->setCode('Instagram_Link');
        $dictionary3->setTitle('Link to "Instagram" social network');
        $dictionary3->setValue('https://www.instagram.com/jr_gimadova/');
        $manager->persist($dictionary3);
        
        $dictionary4 = new Dictionary();
        $dictionary4->setCode('twitter_Link');
        $dictionary4->setTitle('Link to "twitter" social network');
        $dictionary4->setValue('https://twitter.com/WENeed_ROCK');
        $manager->persist($dictionary4);
        
        $dictionary5 = new Dictionary();
        $dictionary5->setCode('phone');
        $dictionary5->setTitle('phone nubmer');
        $dictionary5->setValue('(+375 17) 327-88-23');
        $manager->persist($dictionary5);
        
        $dictionary6 = new Dictionary();
        $dictionary6->setCode('address');
        $dictionary6->setTitle('the department address');
        $dictionary6->setValue('Str. Gikalo, 9, Minsk');
        $manager->persist($dictionary6);
        $manager->flush();
    }
}
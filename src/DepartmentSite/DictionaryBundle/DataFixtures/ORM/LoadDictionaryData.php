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
        $dictionary1->setTitle('Ссылка на "Вконтакте"');
        $dictionary1->translate('ru')->setValue('https://new.vk.com/kozlova_oxana');
        $manager->persist($dictionary1);
        $dictionary1->mergeNewTranslations();
        
        $dictionary2 = new Dictionary();
        $dictionary2->setCode('facebook_Link');
        $dictionary2->setTitle('Ссылка на "facebook"');
        $dictionary2->translate('ru')->setValue('https://www.facebook.com/groups/vmsis/?fref=nf');
        $manager->persist($dictionary2);
        $dictionary2->mergeNewTranslations();
        
        $dictionary3 = new Dictionary();
        $dictionary3->setCode('Instagram_Link');
        $dictionary3->setTitle('Ссылка на "Instagram"');
        $dictionary3->translate('ru')->setValue('https://www.instagram.com/marina.bard/');
        $manager->persist($dictionary3);
        $dictionary3->mergeNewTranslations();
        
        $dictionary4 = new Dictionary();
        $dictionary4->setCode('twitter_Link');
        $dictionary4->setTitle('Ссылка на "twitter"');
        $dictionary4->translate('ru')->setValue('https://twitter.com/bsuirby');
        $manager->persist($dictionary4);
        $dictionary4->mergeNewTranslations();

        $dictionary5 = new Dictionary();
        $dictionary5->setCode('phone');
        $dictionary5->setTitle('номер телефона');
        $dictionary5->translate('ru')->setValue('(+375 17) 327-88-23');
        $manager->persist($dictionary5);
        $dictionary5->mergeNewTranslations();

        $dictionary6 = new Dictionary();
        $dictionary6->setCode('address');
        $dictionary6->setTitle('адрес кафедры');
        $dictionary6->translate('ru')->setValue('Улица Гикало, 9, Минск');
        $dictionary6->translate('en')->setValue('Str. Gikalo, 9, Minsk');
        $manager->persist($dictionary6);
        $dictionary6->mergeNewTranslations();

        $dictionary7 = new Dictionary();
        $dictionary7->setCode('advert');
        $dictionary7->translate('ru')->setValue('Объявления');
        $dictionary7->translate('en')->setValue('Advertisements');
        $manager->persist($dictionary7);
        $dictionary7->mergeNewTranslations();

        $dictionary8 = new Dictionary();
        $dictionary8->setCode('all_advert');
        $dictionary8->translate('ru')->setValue('Все объявления');
        $dictionary8->translate('en')->setValue('All advertisements');
        $manager->persist($dictionary8);
        $dictionary8->mergeNewTranslations();

        $dictionary9 = new Dictionary();
        $dictionary9->setCode('news');
        $dictionary9->translate('ru')->setValue('Новости кафедры');
        $dictionary9->translate('en')->setValue('Department news');
        $manager->persist($dictionary9);
        $dictionary9->mergeNewTranslations();

        $dictionary10 = new Dictionary();
        $dictionary10->setCode('all_news');
        $dictionary10->translate('ru')->setValue('Все новости');
        $dictionary10->translate('en')->setValue('All news');
        $manager->persist($dictionary10);
        $dictionary10->mergeNewTranslations();

        $dictionary11 = new Dictionary();
        $dictionary11->setCode('authors_first_part');
        $dictionary11->translate('ru')->setValue('Учебно-исследовательский проект');
        $dictionary11->translate('en')->setValue('Educational and research project');
        $manager->persist($dictionary11);
        $dictionary11->mergeNewTranslations();

        $dictionary12 = new Dictionary();
        $dictionary12->setCode('authors_second_part');
        $dictionary12->translate('ru')->setValue('совместной лаборатории БГУИР и IBA');
        $dictionary12->translate('en')->setValue('co-lab BSUIR and IBA');
        $manager->persist($dictionary12);
        $dictionary12->mergeNewTranslations();

        $dictionary13 = new Dictionary();
        $dictionary13->setCode('map');
        $dictionary13->translate('ru')->setValue('схема проезда');
        $dictionary13->translate('en')->setValue('location map');
        $manager->persist($dictionary13);
        $dictionary13->mergeNewTranslations();

        $dictionary14 = new Dictionary();
        $dictionary14->setCode('login_link');
        $dictionary14->translate('ru')->setValue('Регистрация | Войти');
        $dictionary14->translate('en')->setValue('Sign Up | Log In');
        $manager->persist($dictionary14);
        $dictionary14->mergeNewTranslations();

        /////////////////////////////////////

        $dictionary15 = new Dictionary();
        $dictionary15->setCode('log_in');
        $dictionary15->translate('ru')->setValue('Войти на сайт');
        $dictionary15->translate('en')->setValue('Sign In');
        $manager->persist($dictionary15);
        $dictionary15->mergeNewTranslations();

        $dictionary16 = new Dictionary();
        $dictionary16->setCode('sign_up');
        $dictionary16->translate('ru')->setValue('Регистрация');
        $dictionary16->translate('en')->setValue('Sign Up');
        $manager->persist($dictionary16);
        $dictionary16->mergeNewTranslations();

        $dictionary17 = new Dictionary();
        $dictionary17->setCode('forgot_password');
        $dictionary17->translate('ru')->setValue('Забыли пароль?');
        $dictionary17->translate('en')->setValue('Forgot Password?');
        $manager->persist($dictionary17);
        $dictionary17->mergeNewTranslations();

        $dictionary18 = new Dictionary();
        $dictionary18->setCode('login_placeholder');
        $dictionary18->translate('ru')->setValue('Логин');
        $dictionary18->translate('en')->setValue('Login');
        $manager->persist($dictionary18);
        $dictionary18->mergeNewTranslations();

        $dictionary19 = new Dictionary();
        $dictionary19->setCode('password_placeholder');
        $dictionary19->translate('ru')->setValue('Пароль');
        $dictionary19->translate('en')->setValue('Password');
        $manager->persist($dictionary19);
        $dictionary19->mergeNewTranslations();

        $dictionary20 = new Dictionary();
        $dictionary20->setCode('login_button');
        $dictionary20->translate('ru')->setValue('Войти');
        $dictionary20->translate('en')->setValue('Log In');
        $manager->persist($dictionary20);
        $dictionary20->mergeNewTranslations();

        $manager->flush();
    }
}
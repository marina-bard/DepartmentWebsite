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
    private function createDictionary(ObjectManager &$manager, $code, $ru_value, $en_value)
    {
        $dictionary = new Dictionary();
        $dictionary->setCode($code);
        $dictionary->translate('ru')->setValue($ru_value);
        $dictionary->translate('en')->setValue($en_value);
        $manager->persist($dictionary);
        $dictionary->mergeNewTranslations();
    }

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

        $dictionary21 = new Dictionary();
        $dictionary21->setCode('projects');
        $dictionary21->translate('ru')->setValue('Информация по проектам студентов');
        $dictionary21->translate('en')->setValue('Students projects information');
        $manager->persist($dictionary21);
        $dictionary21->mergeNewTranslations();

        $dictionary22 = new Dictionary();
        $dictionary22->setCode('all_projects');
        $dictionary22->translate('ru')->setValue('Все проекты');
        $dictionary22->translate('en')->setValue('All projects');
        $manager->persist($dictionary22);
        $dictionary22->mergeNewTranslations();

        $dictionary23 = new Dictionary();
        $dictionary23->setCode('search_in_projects');
        $dictionary23->translate('ru')->setValue('Поиск по теме проекта');
        $dictionary23->translate('en')->setValue('Search by topic');
        $manager->persist($dictionary23);
        $dictionary23->mergeNewTranslations();

        $dictionary24 = new Dictionary();
        $dictionary24->setCode('reviews');
        $dictionary24->translate('ru')->setValue('Отзывы');
        $dictionary24->translate('en')->setValue('Reviews');
        $manager->persist($dictionary24);
        $dictionary24->mergeNewTranslations();

        $dictionary25 = new Dictionary();
        $dictionary25->setCode('comments');
        $dictionary25->translate('ru')->setValue('Комментарии студентов');
        $dictionary25->translate('en')->setValue('Students comments');
        $manager->persist($dictionary25);
        $dictionary25->mergeNewTranslations();

        $dictionary26 = new Dictionary();
        $dictionary26->setCode('course');
        $dictionary26->translate('ru')->setValue('курс');
        $dictionary26->translate('en')->setValue('course');
        $manager->persist($dictionary26);
        $dictionary26->mergeNewTranslations();

        $this->createDictionary($manager, 'to_projects_list', 'К списку проектов', 'To projects list');
        $this->createDictionary($manager, 'next_project', 'К следующему', 'Next project');
        $this->createDictionary($manager, 'previous_project', 'К предыдущему', 'Previous project');
        $this->createDictionary($manager, 'group', 'группа', 'group');
        $this->createDictionary($manager, 'student', 'Студент', 'Student');
        $this->createDictionary($manager, 'teacher', 'Руководитель', 'Teacher');
        $this->createDictionary($manager, 'reviewer', 'Рецендист', 'Reviewer');
        $this->createDictionary($manager, 'start_date', 'Дата начала проекта', 'Start date');
        $this->createDictionary($manager, 'end_date', 'Дата завершения проекта', 'End date');
        $this->createDictionary($manager, 'project_description', 'Описание проекта', 'Description');
        $this->createDictionary($manager, 'teacher_and_reviewer_comments', 'Отзывы руководителя и рецендиста', 'Teacher and reviewer comments');
        $this->createDictionary($manager, 'message_to_regitster', 'Только зарегистрированные пользователи могут оставлять комментарии.',
            'Only registered users can leave comments');
        $this->createDictionary($manager, 'please', 'пожалуйста', 'please');
        $this->createDictionary($manager, 'login_to_comment', 'Войдите,', 'Log In,');
        
        $manager->flush();
    }
}
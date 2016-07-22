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
use Doctrine\DBAL\Types\BooleanType;

class LoadDictionaryData implements FixtureInterface
{
    private function createDictionary(ObjectManager &$manager, $code, $ru_value, $isTranslatable, $en_value = null)
    {
        $dictionary = new Dictionary();
        $dictionary->setCode($code);
        $dictionary->translate('ru')->setValue($ru_value);
        if( $isTranslatable)
            $dictionary->translate('en')->setValue($en_value);
        $manager->persist($dictionary);
        $dictionary->mergeNewTranslations();
    }

    public function load(ObjectManager $manager)
    {
        $this->createDictionary($manager, 'VK_Link', 'https://new.vk.com/kozlova_oxana', false);
        $this->createDictionary($manager, 'facebook_Link', 'https://www.facebook.com/groups/vmsis/?fref=nf', false);
        $this->createDictionary($manager, 'Instagram_Link', 'https://www.instagram.com/marina.bard/', false);
        $this->createDictionary($manager, 'twitter_Link', 'https://twitter.com/bsuirby', false);
        $this->createDictionary($manager, 'phone', '(+375 17) 327-88-23', false);
        $this->createDictionary($manager, 'address', 'Улица Гикало, 9, Минск', true, 'Str. Gikalo, 9, Minsk');
        $this->createDictionary($manager, 'advert', 'Объявления', true, 'Advertisements');
        $this->createDictionary($manager, 'all_advert', 'Все объявления', true, 'All advertisements');
        $this->createDictionary($manager, 'news', 'Новости кафедры', true, 'Department news');
        $this->createDictionary($manager, 'all_news', 'Все новости', true, 'All news');
        $this->createDictionary($manager, 'authors_first_part', 'Учебно-исследовательский проект', true,
            'Educational and research project');
        $this->createDictionary($manager, 'authors_second_part', 'совместной лаборатории БГУИР и IBA', true,
            'co-lab BSUIR and IBA');
        $this->createDictionary($manager, 'map', 'схема проезда', true, 'location map');
        $this->createDictionary($manager, 'login_link', 'Регистрация | Войти', true, 'Sign Up | Log In');
        $this->createDictionary($manager, 'log_in', 'Войти на сайт', true, 'Sign In');
        $this->createDictionary($manager, 'sign_up', 'Регистрация', true, 'Sign Up');
        $this->createDictionary($manager, 'forgot_password', 'Забыли пароль?', true, 'Forgot Password?');
        $this->createDictionary($manager, 'login_placeholder', 'Логин', true, 'Login');
        $this->createDictionary($manager, 'password_placeholder', 'Пароль', true, 'Password');
        $this->createDictionary($manager, 'login_button', 'Войти', true, 'Log In');
        $this->createDictionary($manager, 'projects', 'Информация по проектам студентов', true,
            'Students projects information');
        $this->createDictionary($manager, 'all_projects', 'Все проекты', true, 'All projects');
        $this->createDictionary($manager, 'search_in_projects', 'Поиск по теме проекта', true, 'Search by topic');
        $this->createDictionary($manager, 'reviews', 'Отзывы', true, 'Reviews');
        $this->createDictionary($manager, 'comments', 'Комментарии студентов', true, 'Students comments');
        $this->createDictionary($manager, 'course', 'курс', true, 'course');

        $this->createDictionary($manager, 'to_projects_list', 'К списку проектов', true, 'To projects list');
        $this->createDictionary($manager, 'next_project', 'К следующему проекту', true, 'Next project');
        $this->createDictionary($manager, 'previous_project', 'К предыдущему проекту', true, 'Previous project');

        $this->createDictionary($manager, 'to_advert_list', 'К списку объявлений', true, 'To advert list');
        $this->createDictionary($manager, 'next_advert', 'К следующему объявлению', true, 'Next advert');
        $this->createDictionary($manager, 'previous_advert', 'К предыдущему объявлению', true, 'Previous advert');

        $this->createDictionary($manager, 'to_news_list', 'К списку новостей', true, 'To news list');
        $this->createDictionary($manager, 'next_news', 'К следующей', true, 'Next news');
        $this->createDictionary($manager, 'previous_news', 'К предыдущей', true, 'Previous news');

        $this->createDictionary($manager, 'group', 'группа', true, 'group');
        $this->createDictionary($manager, 'student', 'Студент', true, 'Student');
        $this->createDictionary($manager, 'teacher', 'Руководитель', true, 'Teacher');
        $this->createDictionary($manager, 'reviewer', 'Рецендист', true, 'Reviewer');
        $this->createDictionary($manager, 'start_date', 'Дата начала проекта', true, 'Start date');
        $this->createDictionary($manager, 'end_date', 'Дата завершения проекта', true, 'End date');
        $this->createDictionary($manager, 'project_description', 'Описание проекта', true, 'Description');
        $this->createDictionary($manager, 'teacher_and_reviewer_comments', 'Отзывы руководителя и рецендиста', true,
            'Teacher and 
         comments');
        $this->createDictionary($manager, 'message_to_regitster',
            'Только зарегистрированные пользователи могут оставлять комментарии.', true,
            'Only registered users can leave comments');
        $this->createDictionary($manager, 'please', 'пожалуйста', true, 'please');
        $this->createDictionary($manager, 'login_to_comment', 'Войдите,', true, 'Log In,');
        $this->createDictionary($manager, 'location', 'https://yandex.com/maps/157/minsk/?ll=27.596119,53.91..', false);
        $this->createDictionary($manager, 'btn_comment', 'Написать', true, 'Comment');
        $manager->flush();
    }
}
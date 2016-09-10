<?php

/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 26.7.16
 * Time: 21.59
 */
namespace DepartmentSite\PageBundle\DataFixtures\ORM;

use DepartmentSite\PageBundle\Entity\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPage implements FixtureInterface
{
    private function createPage(ObjectManager &$manager, $ru_title, $en_title, $ru_content, $en_content )
    {
        $page = new Page();
        $page->translate('ru')->setTitle($ru_title);
        $page->translate('en')->setTitle($en_title);
        $page->translate('ru')->setContent($ru_content);
        $page->translate('en')->setContent($en_content);
        $page->setTitle($page->translate('en')->getTitle());
        $manager->persist($page);
        $page->mergeNewTranslations();
    }

    public function load(ObjectManager $manager)
    {
        $this->createPage($manager, 'Студентам', 'For students', 'Содержимое студентам', 'Content for students');
        $this->createPage($manager, 'Абитуриентам', 'For applicants', 'Содержимое абитуриентам', 'Content for application');
        $this->createPage($manager, 'Дипломникам', 'For graduate', 'Содержимое дипломникам', 'Content for graduate' );
        $this->createPage($manager, 'Родителям', 'For parents', 'Содержимое родителям', 'Content for parents' );
        $this->createPage($manager, 'Online-курсы', 'online-courses', 'Online-курсы', 'Online-курсы' );
        $this->createPage($manager, 'BIT-CUP', 'bit-cup', 'BIT-CUP', 'BIT-CUP' );
        $this->createPage($manager, 'Олимпиады и конкурсы по програмированию', 'olympiads', 'Олимпиады и конкурсы по програмированию', 'Олимпиады и конкурсы по програмированию' );
        $this->createPage($manager, 'О кафедре', 'About department', 'Кафедра является выпускающей по специальности 40 02 01 "Вычислительные машины, системы и сети" и готовит инженеров-системотехников в области информационных технологий и вычислительной техники. Кафедра создана в 1964 г. под названием кафедра "Математические и счетно-решающие приборы и устройства". В 1970 г. переименована в кафедру "Электронные вычислительные машины". 

В 1976 г. часть учебных дисциплин была передана на кафедру "Вычислительные методы и программирование", а в 1978 г. из состава кафедры была выделена кафедра "Вычислительные системы". С 2000г. ведется подготовка магистрантов по специальности 40 02 01 "Вычислительные машины, системы и сети". Студенты кафедры получают фундаментальные знания в области специальных математических дисциплин, теории вычислительной техники, принципов построения многомашинных и многопроцессорных систем, вычислительных комплексов и сетей, методов и средств автоматизации и проектирования программного обеспечения. 

За время обучения студенты изучают технологию проектирования программного обеспечения ЭВМ, комплексов и сетей, получают твердые навыки программирования на языках Ассемблер, Си, Си++, Java, Perl, HTML, SQL и т.д. Знают системное программное обеспечение ЭВМ и сетей, принципы построения трансляторов, компиляторов и компоновщиков программ, формирование и управление базой данных, умеют их разрабатывать. В области аппаратных средств вычислительной техники студенты получают глубокие знания по схемотехнике элементов вычислительной техники, микропроцессорным компонентам БИС и СБИС, в том числе по ПЛМ и ПЛИС, архитектурам высокопроизводительных процессоров, основам проектирования как отдельных блоков и устройств вычислительной техники, так и ЭВМ, комплексов, специализированных вычислительных систем и компьютерных сетей. Проектированию устройстви блоков ЭВМ студенты обучаются с использованием специальных языков автоматизации проектирования, таких как VHDL, AHDL и т.д., прикладных программ MATLAB, MAX + plus II, Foundation ISE. Выпускники кафедры в совершенстве знают машинную графику и методы обработки графической информации, методы цифровой обработки сигналов и изображений, основные методы защиты информации в сетях, контроль и диагностику средств вычислительной техники. 

За время существования кафедрой подготовлено более 4000 инженеров в области вычислительной техники. Выпускники кафедры работают на предприятиях и в конструкторских бюро, в проектных, планово-экономических организациях, в научно-исследовательских учреждениях и в учебных заведениях, многие из них являются руководителями важных участков производства, ведущими инженерами и исследователями, опытными педагогами и воспитателями трудовых и студенческих коллективов. ', '' );
        $this->createPage($manager, "Образование","education", 'Учебный процесс на кафедре обеспечивается в соответствии с разработанными в БГУИР стандартами специальностей и учебными планами, утвержденными Министерством образования Республики Беларусь. 

Сегодня кафедра ЭВМ обеспечивает подготовку студентов: 
- первой ступени высшего образования по специальности 1-40 02 01 «Вычислительные машины, системы и сети» 
- второй ступени высшего образования по специальностям 1-40 80 03 «Вычислительные машины и системы» и 1-40 81 02 «Интеллектуальные вычислительные комплексы, системы и компьютерные сети» 

Кафедра проводит занятия по следующим дисциплинам: 
-	Автоматизация проектирования вычислительных машин и систем 
-	Администрирование компьютерных систем и сетей 
-	Аппаратное обеспечение компьютерных сетей 
-	Арифметические и логические основы вычислительной техники 
-	Архитектура вычислительных машин и систем 
-	Базы данных, знаний и экспертные системы 
-	Вычислительные комплексы, системы и сети 
-	Вычислительные машины и системы 
-	Дискретная математика 
-	Защита информации в вычислительных сетях 
-	Конструирование программ и языки программирования 
-	Конструирование программ и языки программирования 
-	Методы и средства обработки изображений 
-	Объектно-ориентированное проектирование и программирование 
-	Основы алгоритмизации и программирования 
-	Основы проектирования информационных систем 
-	Основы теории управления и системотехники 
-	Системное программное обеспечение вычислительных машин 
-	Системное программное обеспечение локальных компьютерных сетей 
-	Структурная и функциональная организация ЭВМ 
-	Схемотехника 
-	Теория принятия решений 
-	Теория проектирования цифровых устройств и систем 
-	Цифровая обработка сигналов и изображений 

По всем читаемым на кафедре курсам для студентов дневной, заочной и дистанционной форм обучения подготовлены и сданы в библиотеку ЭУМКД 

-	Учебная практика проводится на протяжении учебного года на 1-ом курсе. Целью ее является совершенствование навыков работы за компьютером и закрепление знаний по программированию задач. Каждый студент получает индивидуальное задание. Практическая работа студентов на компьютерах по выполнению заданий практики определяется общеуниверситетским и внутрикафедральным расписаниями. Руководство практикой осуществляет доцент Луцик Ю.А. 
-	Производственная практика организуется и проводится в конце 4-го курса. Распределение студентов на практику проводится в соответствии с заключенными университетом договорами и по частным запросам отдельных предприятий, организаций и учреждений. 
-	Дипломное проектирование на кафедре ЭВМ организовано в соответствии с требованиями Положения о государственных экзаменационных комиссиях высших учебных заведений Республики Беларусь, Инструкции по подготовке, оформлению и представлению к защите дипломных проектов (работ) в высших учебных заведениях, Положения о распределении молодых специалистов к месту распределения. С этой целью в восьмом семестре перед началом производственной практики со студентами дневной формы обучения проводится собрание, на котором студентов ориентируют на выбор тем дипломных проектов (работ) во время прохождения практики. ', '');
        $this->createPage($manager, 'Структура кафедры', 'department-structure','</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <strong>Самаль Дмитрий Иванович</strong>
<br>заведующий кафедрой
<br>доцент, кандидат технических наук
<br>510б-5
<br>293-23-79
<br>Читаемые курсы:
<br>- МГ (Машинная графика)
<br>- СиФО ЭВМ (Структурная и функциональная организация ЭВМ) 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500560" target="_blank">Расписание преподавателя</a>
<br></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr><b>Татур Михаил Михайлович</b>
<br>профессор, доктор технических наук
<br>510-5
<br>293-85-64
<br>Читаемые курсы:
<br>- КиДСВТ (Контроль и диагностика средств вычислительной техники)
<br>- АП ЭВМ (Автоматизация проектирования ЭВМ)
<br>- ТПР (Теория принятия решений)
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500565" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Золоторевич Людмила Андреевна</b>
<br>доцент, кандидат технических наук
<br>512-5 
<br>293-85-66 
<br>Читаемые курсы: 
<br>- Вычислительные машины и системы (ВМиС)
<br>- Контроль и диагностика средств вычислительной техники (КиДСВТ)
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=504530" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Иванов Николай Николаевич</b> 
<br>доцент, кандидат физико-математических наук 
<br>510а-5 
<br>293-86-17 
<br>Читаемые курсы: 
<br>- Основы Теории Управления и Системотехника 
<br>- ВКСиС (Вычислительные комплексы, системы и сети) 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500538" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Кобяк Игорь Петрович</b> 
<br>доцент, кандидат технических наук 
<br>507-5 
<br>293-85-66 
<br>Читаемые курсы: 
<br>- СиФО ЭВМ (Структурная и функциональная организация ЭВМ) 
<br>- Защита Информации в Вычислительных Системах 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500544" target="_blank">Расписание преподавателя</a>
<br></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Лукашевич Марина Михайловна</b> 
<br>доцент, кандидат технических наук 
<br>201-4 
<br>293-80-85 
<br>Читаемые курсы: 
<br>- ЦОСиИ (Цифровая обработка сигналов и изображений)
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500548" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Луцик Юрий Александрович</b> 
<br>доцент, кандидат технических наук 
<br>507-5 
<br>293-86-97 
<br>Читаемые курсы: 
<br>- АиЛОВТ (Арифметические и логические основы вычислительной техники) 
<br>- ОАиП (Основы алгоритмизации и программирования) 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500550" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Одинец Дмитрий Николаевич</b> 
<br>доцент, кандидат технических наук 
<br>507-5 
<br>293-23-89 
<br>Читаемые курсы: 
<br>- Архитектура Вычислительных Машин и Систем (Раздел "Архитектура ПЭВМ") 
<br>- Архитектура ПЭВМ 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500552" target="_blank">Расписание преподавателя</a>
<br></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr><b>Прытков Валерий Александрович</b> 
<br>декан ФКСиС
<br>доцент,кандидат технических наук
<br>201-4
<br>293-86-63 
<br>Читаемые курсы: 
<br>- Архитектура вычислительных машин и систем
<br>- Архитектура персональных компьютеров 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500526" target="_blank">Расписание преподавателя</a>
<br></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Тимошенко Василий Степанович</b> 
<br>доцент, кандидат технических наук 
<br>506-5 
<br>293-85-68 
<br>Читаемые курсы: 
<br>- Схемотехника 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500566" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Фролов Игорь Иванович</b> 
<br>доцент, кандидат технических наук 
<br>Читаемые курсы: 
<br>- Физика ЭВМ 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500568" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <strong>Байрак Сергей Анатольевич</strong> 
<br>старший преподаватель 
<br>507-5 
<br>293-23-89 
<br>Читаемые курсы: 
<br>- Схемотехника 
<br>- Архитектура ПЭВМ 
<br>- АП ЭВМ (Автоматизация проектирования ЭВМ) 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500530" target="_blank">Расписание преподавателя</a>
<br></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Глецевич Иван Иванович</b> 
<br><a href="/ru/kaf-evm/gletsevich-i-i" target="_blank">Персональная страница</a>
<br>509-5 
<br>293-85-87 
<br>Читаемые курсы: 
<br>- Проектирование ЛВС 
<br>- ВКСиС (Вычислительные комплексы, системы и сети) 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500534" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Искра Наталья Александровна</b> 
<br>старший преподаватель
<br>505а-5 
<br>293-80-39 
<br>Читаемые курсы: 
<br>- ОАиП (Основы алгоритмизации и программирования) 
<br>- ТППО ЭВМ (Технология проектирования програмного обеспечения ЭВМ) 
<br>- Объектно-ориентированное проектирование и программирование
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=502114" target="_blank">Расписание преподавателя </a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Калабухов Евгений Валерьевич </b>
<br>старший преподаватель
<br>507-5 
<br>293-23-89 
<br>Читаемые курсы: 
<br>- КПиЯП (Конструирование программ и языки программирования) 
<br>- БДЗиЭС (Базы данных, знаний и экспертные системы) 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500540" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Ковальчук Анна Михайловна</b> 
<br>старший преподаватель 
<br>501а-5 
<br>293-86-97 
<br>Читаемые курсы: 
<br>- ОАиП (Основы алгоритмизации и программирования) 
<br>- КПиЯП (Конструирование программ и языки программирования) 
<br>- ООП (Объектно-ориентированное программирование) 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500545" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Лукьянова Ирина Викторовна</b> 
<br>старший преподаватель 
<br>501а-5 
<br>293-86-97 
<br>Читаемые курсы: 
<br>- АиЛОВТ (Арифметические и логические основы вычислительной техники) 
<br>- ОАиП (Основы алгоритмизации и программирования) 
<br>- КПиЯП (Конструирование программ и языки программирования) 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500549" target="_blank">Расписание преподавателя</a>
<br></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Кавальчук Александр Николаевич</b> 
<br>ассистент 
<br>501-5 
<br>Читаемые курсы: 
<br>- КПиЯП (Конструирование программ и языки программирования) 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500539" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Остроухова Светлана Александровна</b> 
<br>ассистент 
<br>502-5 
<br>293-85-69 
<br>Читаемые курсы: 
<br>- Архитектура ПЭВМ 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=504382" target="_blank">Расписание преподавателя</a></p>

</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
<tr valign="top">
<td valign="top" style=" width: 10%; ">
<table  align="left"  border="0" cellspacing="0" cellpadding="0">
</td></tr>
</table>

</td>
<td valign="top" style=" width: 50%; ">
<p align="left">
 <hr>
<br><b>Уваров Андрей Александрович</b> 
<br>ассистент 
<br>505а-5 
<br>293-80-39 
<br>Читаемые курсы: 
<br>- Архитектура Вычислительных Машин и Систем (Раздел "Архитектура высокопроизводительных процессоров") 
<br><a href="http://www.bsuir.by/schedule/scheduleEmployee.xhtml?id=500567" target="_blank">Расписание преподавателя</a>
<br></p>

</td>
</tr>
</table>

', '');
        $manager->flush();
    }
}
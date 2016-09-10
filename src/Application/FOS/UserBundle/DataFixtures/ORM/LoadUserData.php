<?php
namespace Application\FOS\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;



class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass('Application\FOS\UserBundle\Entity\TeacherUser');
        $userManager = $this->container->get('pugx_user_manager');
        $user = $userManager->createUser();

        $user->setUsername('admin');
        $user->setEmail('admin@mail.com');
        $user->setPlainPassword('admin');
        $user->setName('Admin');
        $user->setSurname('Admin');
        $user->setPatronymic('Admin');
        $user->setRoles(array('ROLE_SUPER_ADMIN'));
        $user->setEnabled(true);

        $userManager->updateUser($user, true);
    }


    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
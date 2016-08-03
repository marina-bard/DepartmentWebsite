<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\FOS\UserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends \FOS\UserBundle\Controller\ProfileController
{
    public function getUserInfoAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        return new JsonResponse($user);
    }
    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userManager = $this->get('fos_user.user_manager');

        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setName($request->get('name'));
        $user->setSurname($request->get('surname'));
        $user->setPatronymic($request->get('patronymic'));
        if($request->get('studyGroup'))
            $user->setStudyGroup($request->get('studyGroup'));
        if($request->get('studentGroup'))
            $user->setStudentGroup($request->get('studentGroup'));

        $userManager->updateUser($user);

//        if (null === $response = $event->getResponse()) {
//            $url = $this->generateUrl('fos_user_profile_show');
//            $response = new RedirectResponse($url);
//        }
        
        return new JsonResponse("Профиль пользователя успешно обновлён.");
        
    }
}

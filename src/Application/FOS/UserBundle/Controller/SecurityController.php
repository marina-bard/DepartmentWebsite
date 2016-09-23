<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 22.7.16
 * Time: 11.37
 */

namespace Application\FOS\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController
{
    public function renderLogin(array $data)
    {
        $requestAttributes = $this->container->get('request_stack')->getCurrentRequest()->attributes;

        if ('admin_login' === $requestAttributes->get('_route')) {
            $template = sprintf('ApplicationFOSUserBundle:Security:login_admin.html.twig');
        } else {
            $template = sprintf('FOSUserBundle:Security:login.html.twig');
        }

        return $this->container->get('templating')->renderResponse($template, $data);
    }


}
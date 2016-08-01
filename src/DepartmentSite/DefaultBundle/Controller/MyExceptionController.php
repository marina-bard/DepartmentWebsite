<?php


namespace DepartmentSite\DefaultBundle\Controller;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Bundle\TwigBundle\Controller\ExceptionController;

class MyExceptionController extends ExceptionController {
    public function showAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null)
    {
//        $currentContent = $this->getAndCleanOutputBuffering($request->headers->get('X-Php-Ob-Level', -1));
//        $showException = $request->attributes->get('showException', $this->debug); // As opposed to an additional parameter, this maintains BC
//
//        $code = $exception->getStatusCode();
//
//        return new Response($this->twig->render(
//            (string) $this->findTemplate($request, $request->getRequestFormat(), $code, $showException),
//            array(
//                'status_code' => $code,
//                'status_text' => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : '',
//                'exception' => $exception,
//                'logger' => $logger,
//                'currentContent' => $currentContent,
//                '_locale' => 'ru'
//            )
//        ));

//        $code = $exception->getStatusCode();
//        return new Response($this->twig->render(
//            (string) $this->findTemplate($request, $request->getRequestFormat(), $code, $showException),
//            array(
//                'status_code' => $code,
//                'status_text' => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : '',
//                'exception' => $exception,
//                'logger' => $logger,
//                'currentContent' => $currentContent,
//                '_locale' => 'ru'
//            )
//        ));

        return  new Response((string)$this->findTemplate($request, $request->getRequestFormat(), "null"));
    }
}
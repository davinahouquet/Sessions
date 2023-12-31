<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RouteNotFoundSubscriber implements EventSubscriberInterface
{
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        if($exception = $event->getThrowable()){
            $redirectUrl = $this->urlGenerator->generate('app_redirection');
    
            $response = new RedirectResponse($redirectUrl);
    
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents()
    {
        return  [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

}
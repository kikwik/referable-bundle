<?php


namespace Kikwik\ReferableBundle\EventListener;


use Kikwik\ReferableBundle\Service\RefererManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class RefererRequestSubscriber implements EventSubscriberInterface
{
    /**
     * @var \Kikwik\ReferableBundle\Service\RefererManager
     */
    private $refererManager;

    public function __construct(RefererManager $refererManager)
    {
        $this->refererManager = $refererManager;
    }

    public function onRequestEvent(RequestEvent $event)
    {
        if($event->isMainRequest())
        {
            $request = $event->getRequest();

            $this->refererManager->readRefererFromRequest($request);
        }
    }

    public function onResponseEvent(ResponseEvent $event)
    {
        if($event->isMainRequest())
        {
            $request = $event->getRequest();
            $response = $event->getResponse();

            $this->refererManager->writeRefererCookie($request, $response);
        }
    }


    public static function getSubscribedEvents()
    {
        return [
            ResponseEvent::class => 'onResponseEvent',
            RequestEvent::class => 'onRequestEvent',
        ];
    }
}
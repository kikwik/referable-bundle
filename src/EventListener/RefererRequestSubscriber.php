<?php


namespace Kikwik\ReferableBundle\EventListener;


use Kikwik\ReferableBundle\Service\RefererCookieManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class RefererRequestSubscriber implements EventSubscriberInterface
{
    /**
     * @var \Kikwik\ReferableBundle\Service\RefererCookieManager
     */
    private $cookieManager;

    public function __construct(RefererCookieManager $cookieManager)
    {
        $this->cookieManager = $cookieManager;
    }

    public function onResponseEvent(ResponseEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        $this->cookieManager->checkReferer($request, $response);
    }


    public static function getSubscribedEvents()
    {
        return [
            ResponseEvent::class => 'onResponseEvent'
        ];
    }
}
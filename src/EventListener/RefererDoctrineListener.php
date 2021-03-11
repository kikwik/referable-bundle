<?php


namespace Kikwik\ReferableBundle\EventListener;


use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Kikwik\ReferableBundle\Model\ReferableInterface;
use Kikwik\ReferableBundle\Service\RefererCookieManager;

class RefererDoctrineListener
{
    /**
     * @var \Kikwik\ReferableBundle\Service\RefererCookieManager
     */
    private $cookieManager;

    public function __construct(RefererCookieManager $cookieManager)
    {
        $this->cookieManager = $cookieManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // only act on some "Product" entity
        if (!$entity instanceof ReferableInterface) {
            return;
        }

        $entity->setReferer($this->cookieManager->getCookieValue());
    }
}
<?php


namespace Kikwik\ReferableBundle\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Kikwik\ReferableBundle\Model\CpcReferableInterface;
use Kikwik\ReferableBundle\Model\HttpReferableInterface;
use Kikwik\ReferableBundle\Model\UtmReferableInterface;
use Kikwik\ReferableBundle\Service\RefererManager;

class RefererDoctrineListener
{
    /**
     * @var \Kikwik\ReferableBundle\Service\RefererManager
     */
    private $refererManager;

    public function __construct(RefererManager $refererManager)
    {
        $this->refererManager = $refererManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof HttpReferableInterface)
        {
            $entity->setHttpReferer($this->refererManager->getHttpReferer());
            $entity->setHttpRefererLandingUrl($this->refererManager->getHttpRefererLandingUrl());
        }

        if ($entity instanceof CpcReferableInterface)
        {
            $entity->setCpcReferer($this->refererManager->getCookieValues());
            $this->refererManager->clearCookiesOnNextResponse();
        }

        if ($entity instanceof UtmReferableInterface)
        {
            $entity->setUtmReferer($this->refererManager->getCookieValues());
            $this->refererManager->clearCookiesOnNextResponse();
        }

    }
}
<?php


namespace Kikwik\ReferableBundle\EventListener;


use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Kikwik\ReferableBundle\Model\ReferableInterface;
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

        // only act on some "Product" entity
        if (!$entity instanceof ReferableInterface) {
            return;
        }

        $entity->setHttpReferer($this->refererManager->getHttpReferer());
        $entity->setReferer($this->refererManager->getCookieValue());
    }
}
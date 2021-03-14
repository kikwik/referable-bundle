<?php

namespace Kikwik\ReferableBundle\Model;


interface HttpReferableInterface
{
    public function setHttpReferer(?string $httpReferer);

    public function setHttpRefererLandingUrl(?string $httpRefererLandingUrl);
}
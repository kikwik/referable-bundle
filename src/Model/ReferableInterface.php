<?php

namespace Kikwik\ReferableBundle\Model;


interface ReferableInterface
{
    public function setHttpReferer(?string $httpReferer);

    public function setReferer(?string $referer); // todo: change to UTMs
}
<?php

namespace Kikwik\ReferableBundle\Model;


interface ReferableInterface
{
    public function setReferer(?string $referer);
}
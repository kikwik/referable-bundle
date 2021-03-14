<?php


namespace Kikwik\ReferableBundle\Model;


interface UtmReferableInterface
{
    public function setUtmReferer(array $refererValues);
}
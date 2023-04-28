<?php

namespace Kikwik\ReferableBundle\Model;


trait HttpReferableTrait
{
    /**************************************/
    /* HTTP_REFERER                       */
    /**************************************/

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $httpReferer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $httpRefererLandingUrl;

    public function getHttpReferer(): ?string
    {
        return $this->httpReferer;
    }

    public function setHttpReferer(?string $httpReferer)
    {
        $this->httpReferer = $httpReferer;
        return $this;
    }

    public function getHttpRefererLandingUrl(): ?string
    {
        return $this->httpRefererLandingUrl;
    }

    public function setHttpRefererLandingUrl(?string $httpRefererLandingUrl)
    {
        $this->httpRefererLandingUrl = $httpRefererLandingUrl;
        return $this;
    }
}
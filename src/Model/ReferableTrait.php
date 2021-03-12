<?php

namespace Kikwik\ReferableBundle\Model;


trait ReferableTrait
{
    /**************************************/
    /* HTTP_REFERER                       */
    /**************************************/

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $httpReferer;

    public function getHttpReferer() {
        return $this->httpReferer;
    }

    public function setHttpReferer(?string $httpReferer) {
        $this->httpReferer = $httpReferer;
        return $this;
    }


    /**************************************/
    /* UTMs                               */
    /**************************************/



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refererChannel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refererPartner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refererCreativity;

    public function getReferer(): ?string
    {
        return $this->referer;
    }

    public function setReferer(?string $referer)
    {
        $this->referer = $referer;
        $tmp = explode('-',$referer);
        if(count($tmp)==3)
        {
            $this->refererChannel = $tmp[0];
            $this->refererPartner = $tmp[1];
            $this->refererCreativity = $tmp[2];
        }

        return $this;
    }

    public function getRefererChannel()
    {
        return $this->refererChannel;
    }

    public function getRefererPartner()
    {
        return $this->refererPartner;
    }

    public function getRefererCreativity()
    {
        return $this->refererCreativity;
    }
}
<?php


namespace Kikwik\ReferableBundle\Model;


trait CpcReferableTrait
{
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


    public function setCpcReferer(array $refererValues)
    {
        if(isset($refererValues['CpcReferableInterface']))
        {
            $referer = explode('-',$refererValues['CpcReferableInterface']['r']);
            if(count($referer)==3)
            {
                $this->refererChannel = $referer[0];
                $this->refererPartner = $referer[1];
                $this->refererCreativity = $referer[2];
            }
        }

        return $this;
    }

    public function getRefererChannel(): ?string
    {
        return $this->refererChannel;
    }

    public function getRefererPartner(): ?string
    {
        return $this->refererPartner;
    }

    public function getRefererCreativity(): ?string
    {
        return $this->refererCreativity;
    }


}
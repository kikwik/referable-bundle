<?php


namespace Kikwik\ReferableBundle\Model;


trait UtmReferableTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utmSource;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utmMedium;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utmCampaign;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utmTerm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utmContent;

    public function setUtmReferer(array $refererValues)
    {
        if(isset($refererValues['UtmReferableInterface']))
        {
            $this->utmSource    = isset($refererValues['UtmReferableInterface']['utm_source']) ? $refererValues['UtmReferableInterface']['utm_source'] : null;
            $this->utmMedium    = isset($refererValues['UtmReferableInterface']['utm_medium']) ? $refererValues['UtmReferableInterface']['utm_medium'] : null;
            $this->utmCampaign  = isset($refererValues['UtmReferableInterface']['utm_campaign']) ? $refererValues['UtmReferableInterface']['utm_campaign'] : null;
            $this->utmTerm      = isset($refererValues['UtmReferableInterface']['utm_term']) ? $refererValues['UtmReferableInterface']['utm_term'] : null;
            $this->utmContent   = isset($refererValues['UtmReferableInterface']['utm_content']) ? $refererValues['UtmReferableInterface']['utm_content'] : null;
        }
    }


    public function getUtmSource(): ?string
    {
        return $this->utmSource;
    }

    public function getUtmMedium(): ?string
    {
        return $this->utmMedium;
    }

    public function getUtmCampaign(): ?string
    {
        return $this->utmCampaign;
    }

    public function getUtmTerm(): ?string
    {
        return $this->utmTerm;
    }

    public function getUtmContent(): ?string
    {
        return $this->utmContent;
    }




}
<?php


namespace Kikwik\ReferableBundle\Model;


use Doctrine\ORM\Mapping as ORM;

trait UtmReferableTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $utmSource;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $utmMedium;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $utmCampaign;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $utmTerm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $utmContent;

    public function setUtmReferer(array $refererValues)
    {
        if(isset($refererValues['UtmReferableInterface']))
        {
            $this->utmSource    = $refererValues['UtmReferableInterface']['utm_source'] ?? null;
            $this->utmMedium    = $refererValues['UtmReferableInterface']['utm_medium'] ?? null;
            $this->utmCampaign  = $refererValues['UtmReferableInterface']['utm_campaign'] ?? null;
            $this->utmTerm      = $refererValues['UtmReferableInterface']['utm_term'] ?? null;
            $this->utmContent   = $refererValues['UtmReferableInterface']['utm_content'] ?? null;
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
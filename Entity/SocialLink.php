<?php

/**
 *
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr> 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\PartnerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialLink
 *
 * @ORM\Table(name="idci_partner_social_link")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\PartnerBundle\Repository\SocialLinkRepository")
 */
class SocialLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255)
     */
    private $uri;

    /**
     * partner
     *
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Partner", inversedBy="socialLinks")
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=false)
     */
    protected $partner;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getUri();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uri
     *
     * @param string $uri
     * @return SocialLink
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    
        return $this;
    }

    /**
     * Get uri
     *
     * @return string 
     */
    public function getUri()
    {
        return $this->uri;
    }
    
    /**
     * Set partner
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Partner $partner
     * @return Partner
     */
    public function setPartner(\IDCI\Bundle\PartnerBundle\Entity\Partner $partner = null)
    {
        $this->partner = $partner;
    
        return $this;
    }

    /**
     * Get partner
     *
     * @return \IDCI\Bundle\PartnerBundle\Entity\Partner
     */
    public function getPartner()
    {
        return $this->partner;
    }
}
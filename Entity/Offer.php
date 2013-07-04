<?php

/**
 *
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr> 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\PartnerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="idci_partner_offer")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\PartnerBundle\Repository\OfferRepository")
 */
class Offer
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * partner
     *
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Partner", inversedBy="offers")
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=false, onDelete="Cascade")
     */
    protected $partner;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s: %s", $this->getId(), $this->getName());
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
     * Set name
     *
     * @param string $name
     * @return Offer
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Offer
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set partner
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Partner $partner
     * @return Offer
     */
    public function setPartner(\IDCI\Bundle\PartnerBundle\Entity\Partner $partner)
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

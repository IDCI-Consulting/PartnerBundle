<?php

namespace IDCI\Bundle\PartnerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partner
 *
 * @ORM\Table(name="idci_partner")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\PartnerBundle\Repository\PartnerRepository")
 */
class Partner
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
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * offer
     *
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Offer", inversedBy="partners")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id", onDelete="Set Null", nullable=true)
     */
    protected $offer;
    
    /**
     * location
     *
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Location", inversedBy="partners")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", onDelete="Set Null", nullable=false)
     */
    protected $location;
    
    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\PartnerBundle\Entity\SocialLink", mappedBy="partner")
     */
    protected $socialLinks;
    
    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s : %s", $this->getId(), $this->getName());
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
     * @return Partner
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
     * Set mail
     *
     * @param string $mail
     * @return Partner
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Partner
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * Set location
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Location $location
     * @return Location
     */
    public function setLocation(\IDCI\Bundle\PartnerBundle\Entity\Location $location = null)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return \IDCI\Bundle\PartnerBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }
    
    /**
     * Set offer
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Offer $offer
     * @return Offer
     */
    public function setOffer(\IDCI\Bundle\PartnerBundle\Entity\Offer $offer = null)
    {
        $this->offer = $offer;
    
        return $this;
    }

    /**
     * Get offer
     *
     * @return \IDCI\Bundle\PartnerBundle\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->socialLinks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add socialLinks
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\SocialLink $socialLinks
     * @return Partner
     */
    public function addSocialLink(\IDCI\Bundle\PartnerBundle\Entity\SocialLink $socialLinks)
    {
        $this->socialLinks[] = $socialLinks;
    
        return $this;
    }

    /**
     * Remove socialLinks
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\SocialLink $socialLinks
     */
    public function removeSocialLink(\IDCI\Bundle\PartnerBundle\Entity\SocialLink $socialLinks)
    {
        $this->socialLinks->removeElement($socialLinks);
    }

    /**
     * Get socialLinks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSocialLinks()
    {
        return $this->socialLinks;
    }
}
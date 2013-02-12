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
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Offer", mappedBy="partner", cascade={"persist"})
     */
    protected $offers;

    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Location", mappedBy="partner", cascade={"persist"})
     */
    protected $locations;

    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\PartnerBundle\Entity\SocialLink", mappedBy="partner", cascade={"persist"})
     */
    protected $socialLinks;

    /**
     * categories
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="partners", cascade={"persist"})
     * @ORM\JoinTable(name="idci_partner_partner_category",
     *     joinColumns={@ORM\JoinColumn(name="partner_id", referencedColumnName="id", onDelete="Cascade")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="Cascade")}
     * )
     */
     protected $categories;

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
     * Constructor
     */
    public function __construct()
    {
        $this->offers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->locations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->socialLinks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add offers
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Offer $offer
     * @return Partner
     */
    public function addOffer(\IDCI\Bundle\PartnerBundle\Entity\Offer $offer)
    {
        if(!$offer->getPartner()) {
            $offer->setPartner($this);
        }
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * Remove offers
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Offer $offer
     */
    public function removeOffer(\IDCI\Bundle\PartnerBundle\Entity\Offer $offer)
    {
        $this->offers->removeElement($offer);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * Add location
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Location $location
     * @return Partner
     */
    public function addLocation(\IDCI\Bundle\PartnerBundle\Entity\Location $location)
    {
        if(!$location->getPartner()) {
            $location->setPartner($this);
        }
        $this->locations[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Location $location
     */
    public function removeLocation(\IDCI\Bundle\PartnerBundle\Entity\Location $location)
    {
        $this->locations->removeElement($location);
    }

    /**
     * Get locations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Add socialLink
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\SocialLink $socialLink
     * @return Partner
     */
    public function addSocialLink(\IDCI\Bundle\PartnerBundle\Entity\SocialLink $socialLink)
    {
        if(!$socialLink->getPartner()) {
            $socialLink->setPartner($this);
        }
        $this->socialLinks[] = $socialLink;

        return $this;
    }

    /**
     * Remove socialLink
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\SocialLink $socialLink
     */
    public function removeSocialLink(\IDCI\Bundle\PartnerBundle\Entity\SocialLink $socialLink)
    {
        $this->socialLinks->removeElement($socialLink);
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

    /**
     * Add category
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Category $category
     * @return Partner
     */
    public function addCategorie(\IDCI\Bundle\PartnerBundle\Entity\Category $category)
    {
        $this->categories[] = $category;
    
        return $this;
    }

    /**
     * Remove category
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Category $category
     */
    public function removeCategorie(\IDCI\Bundle\PartnerBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}

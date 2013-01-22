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
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Offer", mappedBy="partner")
     */
    protected $offers;
    
    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Location", mappedBy="partner")
     */
    protected $locations;
    
    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\PartnerBundle\Entity\SocialLink", mappedBy="partner")
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
     * @param \IDCI\Bundle\PartnerBundle\Entity\Offer $offers
     * @return Partner
     */
    public function addOffer(\IDCI\Bundle\PartnerBundle\Entity\Offer $offers)
    {
        $this->offers[] = $offers;
    
        return $this;
    }

    /**
     * Remove offers
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Offer $offers
     */
    public function removeOffer(\IDCI\Bundle\PartnerBundle\Entity\Offer $offers)
    {
        $this->offers->removeElement($offers);
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
     * Add locations
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Location $locations
     * @return Partner
     */
    public function addLocation(\IDCI\Bundle\PartnerBundle\Entity\Location $locations)
    {
        $this->locations[] = $locations;
    
        return $this;
    }

    /**
     * Remove locations
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Location $locations
     */
    public function removeLocation(\IDCI\Bundle\PartnerBundle\Entity\Location $locations)
    {
        $this->locations->removeElement($locations);
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

    /**
     * Add categories
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Category $categories
     * @return Partner
     */
    public function addCategorie(\IDCI\Bundle\PartnerBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    
        return $this;
    }

    /**
     * Remove categories
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Category $categories
     */
    public function removeCategorie(\IDCI\Bundle\PartnerBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
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
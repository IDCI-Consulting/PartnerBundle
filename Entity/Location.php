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
 * Location
 *
 * @ORM\Entity(repositoryClass="IDCI\Bundle\PartnerBundle\Repository\LocationRepository")
 * @ORM\Table(name="idci_partner_location", indexes={
 *    @ORM\Index(name="city_idx", columns={"city"}),
 *    @ORM\Index(name="zip_code_idx", columns={"zip_code"}),
 *    @ORM\Index(name="country_idx", columns={"country"})
 * }))
 */
class Location
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=255, nullable=true)
     */
    private $zip_code;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * partner
     *
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Partner", inversedBy="locations")
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
        return sprintf("%s: %s %s %s",
            $this->getName(),
            $this->getCountry(),
            $this->getCity(),
            $this->getZipCode()
        );
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
     * @return Location
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
     * Set address
     *
     * @param string $address
     * @return Location
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zip_code
     *
     * @param string $zipCode
     * @return Location
     */
    public function setZipCode($zipCode)
    {
        $this->zip_code = $zipCode;
    
        return $this;
    }

    /**
     * Get zip_code
     *
     * @return string 
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Location
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Location
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set partner
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Partner $partner
     * @return Location
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

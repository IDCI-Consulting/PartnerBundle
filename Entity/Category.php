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
use IDCI\Bundle\PartnerBundle\Util\StringTools;

/**
 * Category
 *
 * @ORM\Table(name="idci_partner_category")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\PartnerBundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Category
{
    /**
     * Get tree separator
     *
     * @return string
     */
    public static function getTreeSeparator()
    {
        return '-';
    }

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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=128, unique=true)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tree;

    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Category", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\PartnerBundle\Entity\Partner", mappedBy="categories")
     */
    private $partners;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        if($this->getParent()) {
            return sprintf('%s > %s',
                $this->getParent(),
                $this->getName()
            );
        }

        return $this->getName();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->partners = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Slugify
     */
    public function slugify()
    {
        $this->setSlug(StringTools::slugify($this->getName()));
    }

    /**
     * hasParent
     *
     * @return boolean
     */
    public function hasParent()
    {
        return null !== $this->getParent();
    }

    /**
     * buildTree
     *
     * @return string
     */
    public function buildTree()
    {
        if(!$this->hasParent()) {
            return null;
        }

        return sprintf('%s%d%s',
            $this->getParent()->getTree(),
            $this->getParent()->getId(),
            self::getTreeSeparator()
        );
    }

    /**
     * updateTree
     *
     * @return boolean
     */
    public function updateTree()
    {
        $tree = $this->getTree();
        $this->setTree($this->buildTree());

        return $tree != $this->getTree();
    }

    /**
     * countLevel
     *
     * @return integer
     */
    public function countLevel()
    {
        if(!$this->hasParent()) {
            return 0;
        }

        return $this->getParent()->getLevel() + 1;
    }

    /**
     * updateLevel
     *
     * @return boolean
     */
    public function updateLevel()
    {
        $level = $this->getLevel();
        $this->setLevel($this->countLevel());

        return $level != $this->getLevel();
    }

    /**
     * updateHierachyFields
     *
     * @return boolean
     */
    public function updateHierachyFields()
    {
        $treeUpdated = $this->updateTree();
        $levelUpdated = $this->updateLevel();

        return $treeUpdated || $levelUpdated;
    }

    /**
     * onUpdate
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function onUpdate()
    {
        $now = new \DateTime('now');

        $this->slugify();
        $this->updateHierachyFields();
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
     * @return Category
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
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
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
     * Set color
     *
     * @param string $color
     * @return Category
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Category
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set tree
     *
     * @param string $tree
     * @return Category
     */
    public function setTree($tree)
    {
        $this->tree = $tree;
    
        return $this;
    }

    /**
     * Get tree
     *
     * @return string 
     */
    public function getTree()
    {
        return $this->tree;
    }
    
    /**
     * Set parent
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\IDCI\Bundle\PartnerBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \IDCI\Bundle\PartnerBundle\Entity\Category 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add childs
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Category $childs
     * @return Category
     */
    public function addChild(\IDCI\Bundle\PartnerBundle\Entity\Category $childs)
    {
        $this->childs[] = $childs;
    
        return $this;
    }

    /**
     * Remove childs
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Category $childs
     */
    public function removeChild(\IDCI\Bundle\PartnerBundle\Entity\Category $childs)
    {
        $this->childs->removeElement($childs);
    }

    /**
     * Get childs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChilds()
    {
        return $this->childs;
    }
    
    /**
     * Add Partners
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\Partner $partners
     * @return Category
     */
    public function addPartner(\IDCI\Bundle\PartnerBundle\Entity\Partner $partners)
    {
        $this->partners[] = $partners;
    
        return $this;
    }

    /**
     * Remove Partners
     *
     * @param \IDCI\Bundle\PartnerBundle\Entity\CalendarEntity $partners
     */
    public function removePartner(\IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity $partners)
    {
        $this->partners->removeElement($partners);
    }

    /**
     * Get Partners
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartners()
    {
        return $this->partners;
    }
}

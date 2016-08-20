<?php
namespace CodeExample\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Why would a city have phone and fax? Maybe should be renamed to phone and fax prefix?
 * 
 * @Entity
 * @author Jon Skarpeteig
 *        
 */
class City
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @OneToMany(targetEntity="Citizen", mappedBy="city", cascade={"all"})
     */
    private $citizen;
    
    /**
     *
     * @var varchar
     * @Column(type="string")
     */
    private $name;

    /**
     * @var char
     * @Column(type="string", length=2, options={"fixed" = true})
     */
    private $state;

    /**
     * @var int
     * @Column(type="integer")
     */
    private $population;

    /**
     *
     * @var varchar
     * @Column(type="string")
     */
    private $zipcode;

    /**
     * Area as km²
     * @var int
     * @Column(type="integer")
     */
    private $area;

    /**
     * @int
     * @Column(type="integer")
     */
    private $phone;

    /**
     *
     * @var varchar
     * @Column(type="string")
     */
    private $fax;

    public function __construct()
    {
        $this->citizen = new ArrayCollection();
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    public function getPopulation()
    {
        return $this->population;
    }

    public function setPopulation($population)
    {
        $this->population = $population;
        return $this;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function setFax($fax)
    {
        $this->fax = $fax;
        return $this;
    }

    public function getCitizen()
    {
        return $this->citizen;
    }

    public function setCitizen(ArrayCollection $citizen)
    {
        $this->citizen = $citizen;
        return $this;
    }
    
    public function addCitizen(Citizen $citizen)
    {
        if ($this->citizen->contains($citizen)) {
            return;
        }
        
        $this->citizen->add($citizen);
        return $this;
    }
	
    public function removeCitizen(Citizen $citizen)
    {
        if (!$this->citizen->contains($citizen)) {
            return;
        }
        $this->citizen->removeElement($citizen);
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
	
}
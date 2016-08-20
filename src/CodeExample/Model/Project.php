<?php
namespace CodeExample\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @author Jon Skarpeteig
 *
 */
class Project
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ManyToMany(targetEntity="Citizen", mappedBy="projects", cascade={"all"})
     */
    private $citizen;
    
    /**
     *
     * @var varchar
     * @Column(type="string")
     * 
     */
    private $projID;

    /**
     *
     * @var text
     * @Column(type="text")
     */
    private $description;

    /**
     *
     * @var date
     * @Column(type="datetime")
     */
    private $date_start;

    /**
     *
     * @var date
     * @Column(type="datetime")
     */
    private $date_end;

    /**
     *
     * @var float
     * @Column(type="float")
     */
    private $amount;

    /**
     * 
     */
    public function __construct()
    {
        $this->citizen = new ArrayCollection();
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
        $citizen->addProject($this);
        return $this;
    }
	
    public function removeCitizen(Citizen $citizen)
    {
        if (!$this->citizen->contains($citizen)) {
            return;
        }
        $this->citizen->removeElement($citizen);
        $citizen->removeProject($this);
        return $this;
    }
    
    public function getProjID()
    {
        return $this->projID;
    }

    public function setProjID($projID)
    {
        $this->projID = $projID;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDateStart()
    {
        return $this->date_start;
    }

    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
        return $this;
    }

    public function getDateEnd()
    {
        return $this->date_end;
    }

    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
	
}
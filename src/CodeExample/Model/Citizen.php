<?php
namespace CodeExample\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * 
 * @Entity
 * @author Jon Skarpeteig
 *        
 */
class Citizen
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="City", inversedBy="citizen", cascade={"all"})
     * @JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;
    
    /**
     * 
     * @ManyToMany(targetEntity="Project", inversedBy="citizen", cascade={"all"})
     * @JoinTable(name="citizen_projects")
     */
    private $projects;
    
    /**
     *
     * @var varchar 
     * @Column(type="string")
     */
    private $fname;

    /**
     *
     * @var varchar 
     * @Column(type="string")
     */
    private $lname;

    /**
     * int
     *
     * @var int 
     * @Column(type="integer")
     */
    private $age;

    /**
     *
     * @var varchar 
     * @Column(type="string")
     */
    private $address;

    /**
     *
     * @var varchar 
     * @Column(type="string")
     */
    private $mobile;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }
    
    public function getFname()
    {
        return $this->fname;
    }

    public function setFname($fname)
    {
        $this->fname = $fname;
        return $this;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function setLname($lname)
    {
        $this->lname = $lname;
        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(City $city)
    {
        $this->city = $city;
        $city->addCitizen($this);
        return $this;
    }

    public function getProjects()
    {
        return $this->projects;
    }

    public function setProjects(ArrayCollection $projects)
    {
        $this->projects = $projects;
        return $this;
    }
	
    public function addProject(Project $project)
    {
        if ($this->projects->contains($project)) {
            return;
        }
        $this->projects->add($project);
        return $this;
    }
    
    public function removeProject(Project $project)
    {
        if (!$this->projects->contains($project)) {
            return;
        }
        $this->projects->removeElement($project);
        $project->removeCitizen($this);
        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
	
    
}
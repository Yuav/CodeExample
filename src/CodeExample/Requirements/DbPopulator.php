<?php
namespace CodeExample\Requirements;

use CodeExample\Model\City;
use CodeExample\ModelGenerator\CityGenerator;
use Doctrine\Common\Persistence\ObjectManager;
use CodeExample\Model\Citizen;
use CodeExample\Model\Project;
use CodeExample\ModelGenerator\CitizenGenerator;
use CodeExample\ModelGenerator\ProjectGenerator;

class DbPopulator
{
    private $om;
    private $cityGenerator;
    private $citizenGenerator;
    private $projectGenerator;
    
    public function __construct(ObjectManager $om, CityGenerator $cityGenerator, CitizenGenerator $citizenGenerator = null, ProjectGenerator $projectGenerator = null)
    {
        $this->om = $om;
        $this->cityGenerator = $cityGenerator;
        if ($citizenGenerator === null) {
            $this->citizenGenerator = new CitizenGenerator();
        }
        if ($projectGenerator === null) {
            $this->projectGenerator = new ProjectGenerator();
        }
    }

    /**
     * FIXME!!! - Need to use proper DB and code SQL insert queries (batch processing) by hand to get sane speeds
     * An ORM tool is not primarily well-suited for mass inserts, updates or deletions. 
     * Every RDBMS has its own, most effective way of dealing with such operations
     * @param number $cities
     * @param number $citizensPerCity
     * @param number $projectsPerCitizen
     */
    public function fillDatabase($cities=10, $citizensPerCity=10000, $projectsPerCitizen=3)
    {
        $cities = $this->CreateDummyCities(10);
        foreach ($cities as $city) {
            $k = 0;
            $flushInterval = 100;
            for ($i=0;$i<$citizensPerCity;$i++) {
                $citizen = $this->citizenGenerator->generateCitizen();
                $citizen->setCity($city);

                for ($j=0;$j<$projectsPerCitizen;$j++) { 
                    $project = $this->projectGenerator->generateProject();
                    $project->addCitizen($citizen);
                    
                    $this->om->persist($project);
                }
                $this->om->persist($city);
                
                $k++;
                if ($k > $flushInterval) {
                    /**
                     * Bulk inserts in Doctrine are best performed in batches, 
                     * taking advantage of the transactional write-behind behavior of an EntityManager.
                     */
//                     echo "Flushing citizens to DB ($i/$citizensPerCity)\n";
//                     ob_flush();
//                     flush();
                    $this->om->flush(); // Write queued entries to DB
                    $this->om->clear(); // Detaches all objects from Doctrine
                    $k = 1;
                }
            }
        }
        $this->om->flush(); // Flush all changes to database
    }
    
    /**
     * 
     * @param number $num
     * @return array:\CodeExample\Model\City
     */
    public function CreateDummyCities($num=10)
    {
        $cities = array();
        for ($i=0;$i<$num;$i++) {
            $city = $this->CreateDummyCity();
            $cities[] = $city;
        }
        return $cities;
    }
    
    /**
     * 
     * @return \CodeExample\Model\City
     */
    public function CreateDummyCity()
    {
        $city = $this->cityGenerator->generateCity();
        $this->om->persist($city);
        return $city;
    }

}
<?php
namespace CodeExample\Requirements;

use CodeExample\ModelGenerator\CityGenerator;
use CodeExample\DoctrineTestCase;

class DbPopulatorTest extends DoctrineTestCase
{
    
    public function testCreateDummyCitiesAndVerifyInDb()
    {
        // Setup 
        $em = $this->getEntityManager();
        $cityGenerator = new CityGenerator(array('a', 'b'));
        $dbpop = new DbPopulator($em, $cityGenerator);
        
        // Excercise
        $dbpop->CreateDummyCities(10);
        $em->flush();
        
        // Assert
        $cities = $em->getRepository('CodeExample\Model\City')->findAll();
        $this->assertCount(10, $cities);
    }
    
    public function testCreateCitiesCitizenAndProjectsAndFetchFromDb()
    {
        // Setup
        $em = $this->getEntityManager();
        $cityGenerator = new CityGenerator(array('a', 'b'));
        $dbpop = new DbPopulator($em, $cityGenerator);
        
        // Exercise
        $dbpop->fillDatabase(10, 20, 3);
        
        // Assert
        $cities = $em->getRepository('CodeExample\Model\City')->findAll();
        $this->assertCount(10, $cities);
        $city = array_pop($cities);
        $citizens = $city->getCitizen();
        $this->assertCount(20, $citizens);
        $citizen = $citizens[0];
        
        $projects = $citizen->getProjects();
        $this->assertCount(3, $projects);
        
        $citizens = $em->getRepository('CodeExample\Model\Citizen')->findAll();
        $this->assertCount(200, $citizens);
        
        $projects = $em->getRepository('CodeExample\Model\Project')->findAll();
        $this->assertCount(600, $projects);
    }
}

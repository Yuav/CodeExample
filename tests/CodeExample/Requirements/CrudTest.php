<?php
namespace CodeExample\Requirements;

use Doctrine\Common\Persistence\ObjectManager;
use CodeExample\Model\Citizen;
use CodeExample\Model\Project;
use CodeExample\Model\City;
use CodeExample;
use CodeExample\DoctrineTestCase;
use CodeExample\ModelGenerator\CityGenerator;

class Crud extends DoctrineTestCase
{

    public function testCrudCity()
    {
        $em = $this->getEntityManager();
        
        // Create
        $city = new City();
        $city->setArea('asdf')
            ->setFax(123)
            ->setName('foo')
            ->setPhone(321)
            ->setPopulation(22)
            ->setState('NN')
            ->setZipcode(4123);
        $em->persist($city);
        $em->flush();
        $cityId = $city->getId();
        
        // Read
        $readCity = $em->getRepository('CodeExample\Model\City')->find($cityId);
        $this->assertEquals($city->getArea(), $readCity->getArea());
        $this->assertEquals($city->getName(), $readCity->getName());
        $this->assertEquals($city->getState(), $readCity->getState());
        
        // Update
        $city->setName('newname');
        $em->persist($city);
        $em->flush();
        $updatedCity = $em->getRepository('CodeExample\Model\City')->find($cityId);
        $this->assertEquals($city->getName(), $updatedCity->getName());
        
        // Delete
        $em->remove($city);
        $em->flush();
        $deletedCity = $em->getRepository('CodeExample\Model\City')->find($cityId);
        $this->assertNull($deletedCity);
    }
    
    public function testDataForDisplay()
    {
        // Setup
        $em = $this->getEntityManager();
        $cityGenerator = new CityGenerator(array('a', 'b'));
        $dbpop = new DbPopulator($em, $cityGenerator);
        $dbpop->fillDatabase(10, 20, 3);
    
        $cities = $em->getRepository('CodeExample\Model\City')->findAll();
        $this->assertCount(10, $cities);
        $city = array_pop($cities);
        $citizens = $city->getCitizen();
        
        // Total number of inhabitants per city (using one city)
        $this->assertCount(20, $citizens);
        $citizen = $citizens[0];

        // Total number of projects per city (using one city)
        $q = $em->createQuery('SELECT COUNT(DISTINCT p.id) FROM CodeExample\Model\Project p 
            JOIN p.citizen citi
            JOIN citi.city c
            WHERE c.id = :cityId')->setParameter('cityId', $city->getId());
        
        $result = $q->getResult();
        $projectCount = $result[0][1];
        $this->assertEquals('60', $projectCount);
        
        // Number of inhabitants / km²
        $inhabitantsPerSquareKilometer = $city->getArea() / count($city->getCitizen());
    }
    

}
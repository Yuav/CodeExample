<?php
namespace CodeExample\ModelGenerator;

class CityGeneratorTest extends \PHPUnit_Framework_TestCase
{

    private $cityFixturesFile = 'fixtures/NorwegianCities.json'; 
    
    public function testGenereateCityStateReturnsTwoChars()
    {
        $citiesArray = $this->getCitiesFromFixtures();
        $cityGenerator = new CityGenerator($citiesArray);
        $state = $cityGenerator->generateCityState();
        $this->assertInternalType('string', $state);
        $this->assertEquals(2, strlen($state));
    }
    
    private function getCitiesFromFixtures()
    {
        $countriesToCitiesJson = file_get_contents(__DIR__ . '/../../../' .$this->cityFixturesFile);
        $citiesArray = json_decode($countriesToCitiesJson)->Norway;
        return $citiesArray;
    }
}
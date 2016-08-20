<?php
namespace CodeExample\ModelGenerator;

use CodeExample\Model\City;

class CityGenerator
{

    private $listOfCities;

    public function __construct(array $listOfCities)
    {
        $this->listOfCities = $listOfCities;
    }

    /**
     *
     * @return \CodeExample\Model\City
     */
    public function generateCity()
    {
        $city = new City();
        $city->setName($this->generateCityName());
        $city->setArea($this->generateCityArea());
        $city->setFax($this->generateCityFax());
        $city->setPhone($this->generateCityPhone());
        $city->setPopulation($this->generateCityPopulation());
        $city->setState($this->generateCityState());
        $city->setZipcode($this->generateCityZipcode());
        return $city;
    }

    public function generateCityName()
    {
        $cityName = array_rand($this->listOfCities, 1);
        return $cityName;
    }

    public function generateCityArea()
    {
        return rand(1, 10000);
    }

    public function generateCityFax()
    {
        return rand(10000000, 99999999);
    }

    public function generateCityPhone()
    {
        return rand(10000000, 99999999);
    }

    public function generateCityPopulation()
    {
        return rand(1, 1000000);
    }

    public function generateCityState()
    {
        $uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomOrder = str_shuffle($uppercaseChars);
        return substr($randomOrder, 0, 2);
    }

    public function generateCityZipcode()
    {
        return rand(1000, 9999);
    }
}
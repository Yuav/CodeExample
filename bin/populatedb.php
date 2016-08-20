<?php
use CodeExample\Requirements\DbPopulator;
use CodeExample\ModelGenerator\CityGenerator;

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../vendor/autoload.php';

$norwegianCities = file_get_contents(__DIR__ . '/../fixtures/NorwegianCities.json');
$citiesArray = json_decode($norwegianCities)->Norway;

$cityGenerator = new CityGenerator($citiesArray);
$dbpop = new DbPopulator($entityManager, $cityGenerator);

echo "Filling SQLite database with 300000 entries. Not optimized!! Will take _forever_\n";
//$dbpop->fillDatabase(10, 10000, 3);
$dbpop->fillDatabase(10, 20, 3);

<?php
use Doctrine\ORM\Tools\Setup;
require_once __DIR__ . '/vendor/autoload.php';

// Create a simple "default" Doctrine ORM configuration for XML Mapping
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__.'/src/CodeExample/Model'), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);

// $conn = array(
//     'dbname' => 'codeexample',
//     'user' => 'root',
//     'password' => 'root',
//     'host' => 'localhost',
//     'driver' => 'pdo_mysql',
// );


// obtaining the entity manager
$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

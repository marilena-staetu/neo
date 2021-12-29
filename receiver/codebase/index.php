<?php
require_once(__DIR__.'/vendor/autoload.php');

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("/var/www/src/Entity/");

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'demo_test',
    'password' => 'demo_test',
    'dbname'   => 'demo',
    'port'     => '3306',
    'host'     => 'database'
);

$config = Setup::createAnnotationMetadataConfiguration($paths, true, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);


$entries = $entityManager->getRepository(\Entity\Entry::class)->findAll();


echo 'View messages in the database: <br><br>';
foreach ($entries as $entry) {
    echo sprintf("%s %s <br>", $entry->getId(), $entry->getMessage());
}

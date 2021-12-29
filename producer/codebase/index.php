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

$date = new DateTime();
$entry = new Entity\Entry();
$entry->setMessage(sprintf('This message was inserted into the database by the producer application at %s', $date->format('Y-m-d H:i:s')));

$entityManager->persist($entry);
$entityManager->flush();


$loader = new \Twig\Loader\FilesystemLoader('/var/www/public/');
$twig = new \Twig\Environment($loader);

$nextId = $entry->getId();

echo $twig->render('index.html.twig', ['next_id' => $nextId]);


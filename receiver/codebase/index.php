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

$loader = new \Twig\Loader\FilesystemLoader('/var/www/public/');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.html.twig', ['entries' => $entries, 'link' => 'http://alabala']);

<?php
require_once(__DIR__.'/vendor/autoload.php');

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("/var/www/src/Entity/");

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
    'dbname'   => getenv('MYSQL_DB_NAME'),
    'port'     => getenv('MYSQL_PORT'),
    'host'     => getenv('MYSQL_HOST')
);

$config = Setup::createAnnotationMetadataConfiguration($paths, true, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);


$entries = $entityManager->getRepository(\Entity\Entry::class)->findAll();

$loader = new \Twig\Loader\FilesystemLoader('/var/www/public/');
$twig = new \Twig\Environment($loader);

$producerUrl = getenv('PRODUCER_URL');
echo $twig->render('index.html.twig', ['entries' => $entries, 'producerUrl' => $producerUrl]);

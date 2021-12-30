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

$date = new DateTime();
$entry = new Entity\Entry();
$entry->setMessage(sprintf('This message was inserted into the database by the producer application at %s', $date->format('Y-m-d H:i:s')));

$entityManager->persist($entry);
$entityManager->flush();


$loader = new \Twig\Loader\FilesystemLoader('/var/www/public/');
$twig = new \Twig\Environment($loader);

$nextId = $entry->getId();

$receiverUrl = getenv('RECEIVER_URL');

echo $twig->render('index.html.twig', ['next_id' => $nextId, 'receiverUrl' => $receiverUrl]);


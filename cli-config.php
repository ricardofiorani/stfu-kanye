<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 21:54
 */
require __DIR__ . '/vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require __DIR__ . '/config/container.php';

/** @var \Zend\Expressive\Application $app */
$app = $container->get('Zend\Expressive\Application');
$entityManager = $app->getContainer()->get(\Doctrine\ORM\EntityManager::class);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

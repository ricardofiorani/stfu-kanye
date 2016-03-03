<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 21:04
 */
return [
    'dependencies' => [
        'factories' => [
            \Doctrine\ORM\EntityManager::class => \App\Doctrine\EntityManagerFactory::class,
        ],
    ],
    'doctrine' => [
        'dbname' => getenv('DB_NAME'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'host' => getenv('DB_HOST'),
        /**/
        'entitiesPaths' => [
            __DIR__ . '/../../src/App/Tweet/Entity/'
        ],
        'proxyDir' => __DIR__ . '/../../proxy/',
    ],
];

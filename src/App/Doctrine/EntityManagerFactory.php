<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 21:03
 */

namespace App\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;


/**
 * @author Ricardo Fiorani
 */
class EntityManagerFactory
{

    /**
     * @param ContainerInterface $serviceManager
     * @return EntityManager
     */
    public function __invoke(ContainerInterface $serviceManager)
    {
        /* @var $configArray ContainerInterface */
        $configArray = $serviceManager->get('config');
        $doctrineConfig = $configArray['doctrine'];
        $connectionParams = array(
            'dbname' => $doctrineConfig['dbname'],
            'user' => $doctrineConfig['user'],
            'password' => $doctrineConfig['password'],
            'host' => $doctrineConfig['host'],
            'driver' => 'pdo_mysql',
            'charset' => 'utf8',
            'driverOptions' => array(
                1002 => 'SET NAMES utf8'
            ),
        );

        $entitiesPaths = $doctrineConfig['entitiesPaths'];
        $proxyDir = $doctrineConfig['proxyDir'];
        $isDevMode = $configArray['debug'];

        $setupConfig = Setup::createAnnotationMetadataConfiguration($entitiesPaths, $isDevMode, $proxyDir);
        $setupConfig->addCustomStringFunction('rand', 'Mapado\MysqlDoctrineFunctions\DQL\MysqlRand');
        $setupConfig->addCustomStringFunction('round', 'Mapado\MysqlDoctrineFunctions\DQL\MysqlRound');
        $setupConfig->addCustomStringFunction('date', 'Mapado\MysqlDoctrineFunctions\DQL\MysqlDate');
        $setupConfig->addCustomStringFunction('date_format', 'Mapado\MysqlDoctrineFunctions\DQL\MysqlDateFormat');

        $entityManager = EntityManager::create($connectionParams, $setupConfig);
        $platform = $entityManager->getConnection()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');

        return $entityManager;
    }

}

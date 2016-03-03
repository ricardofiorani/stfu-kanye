<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 20:24
 */

namespace App\Tweet\API\Adapter\Factory;


use App\Tweet\API\Adapter\TwitterAPIConfig;
use Interop\Container\ContainerInterface;

class TwitterAPIConfigFactory
{
    /**
     * @param ContainerInterface $container
     * @return TwitterAPIConfig
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        return new TwitterAPIConfig($config['twitter']);
    }

}

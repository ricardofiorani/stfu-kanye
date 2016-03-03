<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 20:24
 */

namespace App\Tweet\Factory;


use App\Tweet\Settings;
use Interop\Container\ContainerInterface;

class SettingsFactory
{
    /**
     * @param ContainerInterface $container
     * @return Settings
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        return new Settings($config['twitter']);
    }

}

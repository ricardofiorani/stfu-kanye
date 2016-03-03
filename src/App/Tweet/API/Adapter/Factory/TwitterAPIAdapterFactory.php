<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 22:45
 */

namespace App\Tweet\API\Adapter\Factory;


use App\Tweet\API\Adapter\TwitterAPIAdapter;
use App\Tweet\API\Adapter\TwitterAPIConfig;
use Interop\Container\ContainerInterface;

class TwitterAPIAdapterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $twitterSettings = $container->get(TwitterAPIConfig::class);

        return new TwitterAPIAdapter($twitterSettings);
    }
}

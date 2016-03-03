<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 23:36
 */

namespace App\Action;


use App\Tweet\API\Adapter\TwitterAPIAdapter;
use App\Tweet\Entity\Tweet;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class ReplyTweetsFactory
{
    /**
     * @param ContainerInterface $container
     * @return ReplyTweetsAction
     */
    public function __invoke(ContainerInterface $container)
    {

        $twitterRepository = $container->get(EntityManager::class)->getRepository(Tweet::class);
        $twitterAPIAdapter = $container->get(TwitterAPIAdapter::class);

        return new ReplyTweetsAction($twitterRepository, $twitterAPIAdapter);
    }
}

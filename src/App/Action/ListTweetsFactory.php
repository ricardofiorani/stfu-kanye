<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 21/03/2016
 * Time: 16:52
 */

namespace App\Action;


use App\Tweet\Entity\Tweet;
use App\Tweet\Extractor\TweetExtractor;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class ListTweetsFactory
{
    /**
     * @param ContainerInterface $container
     * @return ListTweetsAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $twitterRepository = $container->get(EntityManager::class)->getRepository(Tweet::class);
        $tweetExtractor = $container->get(TweetExtractor::class);

        return new ListTweetsAction($twitterRepository, $tweetExtractor);
    }
}

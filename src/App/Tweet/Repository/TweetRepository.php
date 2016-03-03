<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 22:14
 */

namespace App\Tweet\Repository;


use App\Tweet\Entity\Tweet;
use Doctrine\ORM\EntityRepository;

class TweetRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getNotRepliedTweets()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t')->from('Tweet', 't');
        $qb->where($qb->expr()->eq('t.replied', false));

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @param array $tweets
     */
    public function insertTweetListIntoQueue(array $tweets)
    {
        foreach ($tweets as $rawTweet) {
            $tweet = new Tweet($rawTweet->id_str);
            $this->getEntityManager()->persist($tweet);
            unset($tweet);
        }
        $this->getEntityManager()->flush();
    }

}

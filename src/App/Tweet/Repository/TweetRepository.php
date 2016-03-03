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
        $qb->select('t')->from(Tweet::class, 't');
        $qb->where('t.replied = false');

        return $qb->getQuery()->getResult();
    }

    /**
     * @return int
     */
    public function getRepliedCount()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t')->from(Tweet::class, 't');
        $qb->where('t.replied = true');

        return count($qb->getQuery()->getResult()) + 1;
    }

    /**
     * @param array $tweets
     * @return int the ammount of inserted tweets in queue
     */
    public function insertTweetListIntoQueue(array $tweets)
    {
        $count = 0;
        foreach ($tweets as $rawTweet) {
            if (false == $this->tweetAlreadyInQueue($rawTweet)) {
                $tweet = new Tweet($rawTweet->id_str);
                $this->getEntityManager()->persist($tweet);
                unset($tweet);
                $count++;
            }
        }
        $this->getEntityManager()->flush();

        return $count;
    }

    /**
     * @param $rawTweet
     * @return bool
     */
    private function tweetAlreadyInQueue($rawTweet)
    {
        return $this->findOneBy(['tweetId' => $rawTweet->id_str]) instanceof Tweet;
    }

    public function setTweetReplied(Tweet $tweet)
    {
        $tweet->setReplied();
        $this->getEntityManager()->flush();
    }

}

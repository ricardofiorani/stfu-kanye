<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 22:44
 */

namespace App\Tweet\API\Adapter;


use App\Tweet\Entity\Tweet;
use TwitterAPIExchange;

class TwitterAPIAdapter
{
    /**
     * @var TwitterAPIConfig
     */
    private $twitterApiConfig;


    /**
     * TwitterAPIAdapter constructor.
     * @param TwitterAPIConfig $twitterApiConfig
     */
    public function __construct(TwitterAPIConfig $twitterApiConfig)
    {
        $this->twitterApiConfig = $twitterApiConfig;
    }

    public function getTweets()
    {
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=kanyewest';
        $requestMethod = 'GET';

        $twitterAPI = $this->getNewTwitterAPIExchange();
        $response = $twitterAPI->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        return json_decode($response);
    }

    public function replyTweet(Tweet $tweet, $time)
    {
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $requestMethod = 'POST';
        $postfields = array(
            'status' => '@kanyewest , please shut the fuck up.',
            'in_reply_to_status_id' => $tweet->getTweetId(),
        );
        $twitterAPI = $this->getNewTwitterAPIExchange();
        $response = $twitterAPI->setPostfields($postfields)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        return $response;
    }

    private function getNewTwitterAPIExchange()
    {
        return new TwitterAPIExchange($this->twitterApiConfig->getConfig());
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 23:26
 */

namespace App\Action;


use App\Tweet\API\Adapter\TwitterAPIAdapter;
use App\Tweet\Entity\Tweet;
use App\Tweet\Repository\TweetRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ReplyTweetsAction
{
    /**
     * @var TwitterAPIAdapter
     */
    private $twitterAPIAdapter;
    /**
     * @var TweetRepository
     */
    private $tweetRepository;

    /**
     * ReplyTweetsAction constructor.
     * @param TweetRepository $tweetRepository
     * @param TwitterAPIAdapter $twitterAPIAdapter
     */
    public function __construct(TweetRepository $tweetRepository, TwitterAPIAdapter $twitterAPIAdapter)
    {
        $this->tweetRepository = $tweetRepository;
        $this->twitterAPIAdapter = $twitterAPIAdapter;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $count = 0;
        $errorCounter = 0;
        $tweetList = $this->tweetRepository->getNotRepliedTweets();
        $repliedCount = $this->tweetRepository->getRepliedCount();
        /** @var Tweet $tweet */
        foreach ($tweetList as $tweet) {
            $response = $this->twitterAPIAdapter->replyTweet($tweet, $repliedCount);
            $responseDecoded = json_decode($response);
            if (false == isset($responseDecoded->errors)) {
                $this->tweetRepository->setTweetReplied($tweet);
                $count++;
            } else {
                $errorCounter++;
            }
        }

        return new JsonResponse(['replied' => $count, 'withError' => $errorCounter]);
    }
}

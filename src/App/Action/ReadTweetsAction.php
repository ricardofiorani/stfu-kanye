<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 17:38
 */

namespace App\Action;


use App\Tweet\API\Adapter\TwitterAPIAdapter;
use App\Tweet\Repository\TweetRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ReadTweetsAction
{

    /**
     * @var TweetRepository
     */
    private $tweetRepository;
    /**
     * @var TwitterAPIAdapter
     */
    private $twitterAPIAdapter;

    /**
     * ReadTweetsAction constructor.
     * @param TemplateRendererInterface $template
     * @param TweetRepository $tweetRepository
     * @param TwitterAPIAdapter $twitterAPIAdapter
     */
    public function __construct(
        TweetRepository $tweetRepository,
        TwitterAPIAdapter $twitterAPIAdapter
    ) {
        $this->tweetRepository = $tweetRepository;
        $this->twitterAPIAdapter = $twitterAPIAdapter;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $tweets = $this->twitterAPIAdapter->getTweets();
        $count = $this->tweetRepository->insertTweetListIntoQueue($tweets);

        return new JsonResponse([$count . ' inserted']);
    }

}

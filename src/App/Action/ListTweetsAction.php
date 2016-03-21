<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 21/03/2016
 * Time: 16:52
 */

namespace App\Action;


use App\Tweet\Extractor\TweetExtractor;
use App\Tweet\Repository\TweetRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ListTweetsAction
{
    /**
     * @var TweetRepository
     */
    private $twitterRepository;
    /**
     * @var TweetExtractor
     */
    private $tweetExtractor;

    /**
     * ListLineAction constructor.
     * @param TweetRepository $twitterRepository
     * @param TweetExtractor $tweetExtractor
     */
    public function __construct(TweetRepository $twitterRepository, TweetExtractor $tweetExtractor)
    {
        $this->twitterRepository = $twitterRepository;
        $this->tweetExtractor = $tweetExtractor;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $response = new JsonResponse(array_map($this->tweetExtractor, $this->twitterRepository->findAll()));

        return $next($request, $response);
    }
}

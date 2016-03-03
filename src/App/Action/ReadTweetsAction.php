<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 17:38
 */

namespace App\Action;


use App\Tweet\Repository\TweetRepository;
use App\Tweet\Settings;
use TwitterAPIExchange;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ReadTweetsAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $template;
    /**
     * @var Settings
     */
    private $twitterSettings;
    /**
     * @var TweetRepository
     */
    private $tweetRepository;

    /**
     * ReadTweetsAction constructor.
     * @param TemplateRendererInterface $template
     * @param Settings $twitterSettings
     * @param TweetRepository $tweetRepository
     */
    public function __construct(
        TemplateRendererInterface $template,
        Settings $twitterSettings,
        TweetRepository $tweetRepository
    ) {
        $this->template = $template;
        $this->twitterSettings = $twitterSettings;
        $this->tweetRepository = $tweetRepository;
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
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=kanyewest';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->twitterSettings->getConfig());
        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();


        $this->tweetRepository->insertTweetListIntoQueue(json_decode($response));

        return new JsonResponse(['Inserted']);
    }


}

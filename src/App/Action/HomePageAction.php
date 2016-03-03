<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class HomePageAction
{
    /**
     * @var Router\RouterInterface
     */
    private $router;

    /**
     * @var null|Template\TemplateRendererInterface
     */
    private $template;

    /**
     * HomePageAction constructor.
     * @param Router\RouterInterface $router
     * @param Template\TemplateRendererInterface|null $template
     */
    public function __construct(Router\RouterInterface $router, Template\TemplateRendererInterface $template = null)
    {
        $this->router = $router;
        $this->template = $template;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return HtmlResponse|JsonResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $data = [];

        $data['templateName'] = 'Plates';
        $data['templateDocs'] = 'http://platesphp.com/';

        if (!$this->template) {
            return new JsonResponse([
                'welcome' => 'Congratulations! You have installed the zend-expressive skeleton application.',
                'docsUrl' => 'zend-expressive.readthedocs.org',
            ]);
        }

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}

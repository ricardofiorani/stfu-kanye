<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Action\PingAction::class => App\Action\PingAction::class,
        ],
        'factories' => [
            App\Action\HomePageAction::class => App\Action\HomePageFactory::class,
            App\Action\ReadTweetsAction::class => App\Action\ReadTweetsFactory::class,
            App\Action\ReplyTweetsAction::class => App\Action\ReplyTweetsFactory::class,


        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => App\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.tweets.read',
            'path' => '/api/tweets/read',
            'middleware' => App\Action\ReadTweetsAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.tweets.reply',
            'path' => '/api/tweets/reply',
            'middleware' => App\Action\ReplyTweetsAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];

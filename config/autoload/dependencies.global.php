<?php
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
            App\Tweet\Extractor\TweetExtractor::class => App\Tweet\Extractor\TweetExtractor::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            \App\Tweet\API\Adapter\TwitterAPIConfig::class => \App\Tweet\API\Adapter\Factory\TwitterAPIConfigFactory::class,
            \App\Tweet\API\Adapter\TwitterAPIAdapter::class => \App\Tweet\API\Adapter\Factory\TwitterAPIAdapterFactory::class,
        ],
    ],
];

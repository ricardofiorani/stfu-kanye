<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 18:12
 */

namespace App\Action;


use App\Tweet\Entity\Tweet;
use App\Tweet\Settings;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ReadTweetsFactory
{
    /**
     * @param ContainerInterface $container
     * @return ReadTweetsAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;
        $twitterSettings = $container->get(Settings::class);
        $twitterRepository = $container->get(EntityManager::class)->getRepository(Tweet::class);
        return new ReadTweetsAction($template, $twitterSettings,$twitterRepository);
    }
}

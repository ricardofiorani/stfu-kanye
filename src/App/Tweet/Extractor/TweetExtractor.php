<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 21/03/2016
 * Time: 17:09
 */

namespace App\Tweet\Extractor;


use App\Tweet\Entity\Tweet;

class TweetExtractor
{
    public function __invoke(Tweet $entity)
    {
        return [
            'id' => $entity->getTweetId(),
            'is_replied' => $entity->isReplied(),
        ];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 20:26
 */


return [
    'twitter' => [
        'oauth_access_token' => getenv('OAUTH_ACCESS_TOKEN'),
        'oauth_access_token_secret' => getenv('OAUTH_ACCESS_TOKEN_SECRET'),
        'consumer_key' => getenv('CONSUMER_KEY'),
        'consumer_secret' => getenv('CONSUMER_SECRET')
    ],
];

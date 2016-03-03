<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Fiorani
 * Date: 02/03/2016
 * Time: 20:26
 */


return [
    'twitter' => [
        'oauth_access_token' => getenv('oauth_access_token'),
        'oauth_access_token_secret' => getenv('oauth_access_token_secret'),
        'consumer_key' => getenv('consumer_key'),
        'consumer_secret' => getenv('consumer_secret')
    ],
];

<?php

namespace IlCibe\MobySmsClient;
use GuzzleHttp\Client;

class MobySmsClient
{
    /** @var string */
    const BASE_URL = 'https://app.mobyt.it/';

    /** @var string */
    const USERNAME = '';

    /** @var string */
    const PASSWORD = '';

    /** @var string $userKey */
    private $userKey;

    /** @var string $Session_key  */
    private $sessionKey;

    /** @var $client */
    private $client;

    /**
     * MobySmsClient constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->client = new Client([

            // Base URI is used with relative requests
            'base_uri' => self::BASE_URL,

            // You can set any number of default request options.
            'timeout'  => 10.0
        ]);

    }

}
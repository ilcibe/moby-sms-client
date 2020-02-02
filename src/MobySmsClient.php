<?php

namespace IlCibe\MobySmsClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

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

        $this->login($username, $password);
    }


    /**
     * login
     * @param string $username
     * @param string $password
     * @return array
     */
    private function login($username, $password)
    {
        /** @var array $param */
        $param = [
            'query' => [
                'username' => $username,
                'password' => $password,
            ]
        ];

        /** @var Response $response */
        $response =  $this->client->get( 'API/v1.0/REST/login', $param);

        $resp = explode(';', $response->getBody()->getContents());
        $this->userKey = $resp[0];
        $this->sessionKey = $resp[1];

        return [$this->userKey, $this->sessionKey];
    }


    public function get_credit()
    {
        echo 1;

    }



}
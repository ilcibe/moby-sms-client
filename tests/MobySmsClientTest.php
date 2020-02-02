<?php

namespace IlCibe\MobySmsClient\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use IlCibe\MobySmsClient\MobySmsClient;
use IlCibe\MobySmsClient\Tests\Common\CommonTestCase;
use ReflectionClass;
use ReflectionException;

/**
 * Class MobySmsClientTest
 * @package IlCibe\MobySmsClient\Tests
 */
class MobySmsClientTest extends CommonTestCase
{
    /**
     * @throws ReflectionException
     */
    public function test_instantiateClass()
    {
        /** @var MobySmsClient|ReflectionClass $mobySmsClient */
        $mobySmsClient = $this->createInstanceWithoutConstructor(MobySmsClient::class);
        $this->assertInstanceOf(
            MobySmsClient::class,
            $mobySmsClient
        );
    }

    /**
     * @throws ReflectionException
     */
    public function test_login()
    {
        /** simulazione di una risposta */
        $mock = new MockHandler([
            new Response(200, [], 'pippo;paolo')
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        /** fine simulazione di una risposta */


        /** @var MobySmsClient|ReflectionClass $mobySmsClient */
        $mobySmsClient = $this->createInstanceWithoutConstructor(MobySmsClient::class);

        $this->overridePrivateVar($mobySmsClient, 'client', $client);

        list($username, $password) = $this->invokeMethod($mobySmsClient, 'login', ['str', 'str']);


        $this->assertEquals('pippo', $username);
        $this->assertEquals('paolo', $password);
    }

}
<?php

namespace IlCibe\MobySmsClient\Tests;
use IlCibe\MobySmsClient\MobySmsClient;
use PHPUnit\Framework\TestCase;

class MobySmsClientTest extends TestCase
{
    public function test_instantiateClass(){
        $mobySmsClient = new MobySmsClient('username', 'password');
        $this->assertInstanceOf(
            MobySmsClient::class,
            $mobySmsClient
        );
    }

}
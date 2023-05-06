<?php

namespace RumusBin\OpenAiApiClient\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RumusBin\OpenAiApiClient\OpenAiApiClient;
use RumusBin\OpenAiApiClient\Util\JSON;

class ApiTestCase extends TestCase
{
    protected MockHandler $mock;
    protected OpenAiApiClient $client;

    protected function setUp(): void
    {
        $this->mock = new MockHandler();
        $this->client = OpenAiApiClient::createWithCustomClient(
            'sk-6S3dgT4E35JMCY7KWYCTTBlbkFJDw84kMlZXbg',
            new Client(['handler' => new HandlerStack($this->mock)])
        );
    }

    protected function appendSuccessJson(array $data): void
    {
        $this->mock->append(new Response(200, ['Content-Type' => 'application/json'], JSON::encode($data)));
    }
}
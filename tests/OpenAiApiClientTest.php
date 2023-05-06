<?php

namespace RumusBin\OpenAiApiClient\Tests;

use GuzzleHttp\Psr7\Response;
use RumusBin\OpenAiApiClient\Exception\Domain\UnauthorizedException;

class OpenAiApiClientTest extends ApiTestCase
{
    public function testListAiModels(): void
    {
        $this->mock->append(new Response(200, ['Content-Type' => 'application/json'], $this->getAiModels()));

        $response = $this->client->listAiModels();

        $this->assertEquals(2, $response->count());
    }

    public function testListAiModelsWithUnauthorizedException()
    {
        $this->mock->append(new Response(401, [], json_encode(['message' => 'Unauthorized'])));

        $this->expectException(UnauthorizedException::class);

        $this->client->listAiModels();
    }

    public function testAiModelByName(): void
    {
        $this->mock->append(new Response(200, ['Content-Type' => 'application/json'], $this->getAiModelById()));

        $response = $this->client->aiModelByName('davinci');

        $this->assertEquals('davinci', $response->getId());
    }

    private function getAiModels(): string
    {
        return '{
            "data": [
                {
                    "id": "ada",
                    "object": "ai_model",
                    "created": 1616661715,
                    "fine_tuned": false,
                    "owned_by": "organization:org-7d6f0b0f-5e5f-4c3e-8d5a-2b29f3e5d5a8",
                    "permissions": [
                        "read",
                        "fine_tune"
                    ],
                    "ready": true
                },
                {
                    "id": "davinci",
                    "object": "ai_model",
                    "created": 1616661715,
                    "fine_tuned": false,
                    "owned_by": "organization:org-7d6f0b0f-5e5f-4c3e-8d5a-2b29f3e5d5a8",
                    "permissions": [
                        "read",
                        "fine_tune"
                    ],
                    "ready": true
                }
            ],
            "object": "list"
        }';
    }

    private function getAiModelById(): string
    {
        return '{
            "id": "davinci",
            "object": "ai_model",
            "created": 1616661715,
            "fine_tuned": false,    
            "owned_by": "organization:org-7d6f0b0f-5e5f-4c3e-8d5a-2b29f3e5d5a8",
            "permissions": [
                "read",
                "fine_tune"
            ],
            "ready": true
        }';
    }
}
<?php

namespace RumusBin\OpenAiApiClient;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use RumusBin\OpenAiApiClient\Api\AiModel;
use RumusBin\OpenAiApiClient\Api\Completion\Completion;
use RumusBin\OpenAiApiClient\DTO\Completion\CompletionDto;
use RumusBin\OpenAiApiClient\Http\ClientConfig;
use RumusBin\OpenAiApiClient\Model\Completion\CompletionModel;
use RumusBin\OpenAiApiClient\Model\EngineModel;
use RumusBin\OpenAiApiClient\Model\EngineModelCollection;

class OpenAiApiClient
{
    public function __construct(
        private readonly ClientConfig $clientConfig,
        private readonly ?RequestBuilder $requestBuilder = new RequestBuilder(),
    ) {
    }

    public static function create(
        string $authToken,
    ): self {
        $clientConfigurator = new ClientConfig($authToken);

        return new self($clientConfigurator);
    }

    public static function createWithCustomClient(string $apiKey, ClientInterface $client): self
    {
        return new self(new ClientConfig($apiKey, $client));
    }

    public static function createWithEndpoint(string $authToken, string $endpoint): self
    {
        $clientConfig = new ClientConfig($authToken);
        $clientConfig->setBaseEndpoint($endpoint);

        return new self($clientConfig);
    }

    public static function createForOrganisation(
        string $authToken,
        string $organisationId
    ): self {
        $clientConfig = new ClientConfig($authToken, organizationId: $organisationId);

        return new self($clientConfig);
    }

    /**
     * @return EngineModelCollection
     * @throws ClientExceptionInterface
     * @throws Exception\DomainException
     */
    public function listAiModels(): EngineModelCollection
    {
        return (new AiModel($this->getHttpClient(), $this->requestBuilder))->getAll();
    }

    /**
     * @param string $name
     * @return EngineModel
     * @throws ClientExceptionInterface
     */
    public function aiModelByName(string $name): EngineModel
    {
        return (new AiModel($this->getHttpClient(), $this->requestBuilder))->getModel($name);
    }

    public function getCompletionFor(string|CompletionDto $completion): CompletionModel
    {
        if (is_string($completion)) {
            $completion = new CompletionDto($completion);
        }

        return (new Completion($this->getHttpClient(), $this->requestBuilder))->get($completion);
    }

    private function getHttpClient(): ClientInterface
    {
        return $this->clientConfig->createConfiguredClient();
    }
}
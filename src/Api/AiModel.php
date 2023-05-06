<?php

namespace RumusBin\OpenAiApiClient\Api;

use Psr\Http\Client\ClientExceptionInterface;
use RumusBin\OpenAiApiClient\ErrorHandler;
use RumusBin\OpenAiApiClient\Exception\DomainException;
use RumusBin\OpenAiApiClient\Model\EngineModel;
use RumusBin\OpenAiApiClient\Model\EngineModelCollection;

class AiModel extends BaseHttpApi
{
    /**
     * @param string $specificModel
     * @return EngineModel
     * @throws ClientExceptionInterface
     */
    public function getModel(string $specificModel): EngineModel
    {
        $response = $this->httpGet('/models/' . $specificModel);

        return $this->hydrator->hydrate($response, EngineModel::class);
    }

    /**
     * @return EngineModelCollection
     * @throws ClientExceptionInterface
     * @throws DomainException
     *
     */
    public function getAll(): EngineModelCollection
    {
        $response = $this->httpGet('/models');

        $response->getStatusCode() >= 400 && (new ErrorHandler())->handleResponse($response);

        return $this->hydrator->hydrate($response, EngineModelCollection::class);
    }

}
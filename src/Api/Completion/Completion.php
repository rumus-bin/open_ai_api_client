<?php

namespace RumusBin\OpenAiApiClient\Api\Completion;

use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use RumusBin\OpenAiApiClient\Api\BaseHttpApi;
use RumusBin\OpenAiApiClient\DTO\Completion\CompletionDto;
use RumusBin\OpenAiApiClient\ErrorHandler;
use RumusBin\OpenAiApiClient\Exception\DomainException;
use RumusBin\OpenAiApiClient\Model\Completion\CompletionModel;

class Completion extends BaseHttpApi
{
    /**
     * @param CompletionDto $completionDto
     * @return CompletionModel
     * @throws JsonException
     * @throws ClientExceptionInterface
     * @throws DomainException
     */
    public function get(CompletionDto $completionDto): CompletionModel
    {
        $response = $this->httpPost('/completions', $completionDto->toArray());

        $response->getStatusCode() >= 400 && (new ErrorHandler())->handleResponse($response);

        return $this->hydrator->hydrate($response, CompletionModel::class);
    }
}
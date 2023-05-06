<?php

namespace RumusBin\OpenAiApiClient;

use Psr\Http\Message\ResponseInterface;
use RumusBin\OpenAiApiClient\Exception\Domain as DomainExceptions;
use RumusBin\OpenAiApiClient\Exception\DomainException;

final class ErrorHandler
{
    /**
     * Handle HTTP errors.
     *
     * Call is controlled by the specific API methods.
     *
     * @throws DomainException
     */
    public function handleResponse(ResponseInterface $response): void
    {
        $body = (string)$response->getBody();

        switch ($response->getStatusCode()) {
            case 400:
                throw new DomainExceptions\ValidationException($body);
            case 401:
                throw new DomainExceptions\UnauthorizedException($body);
            case 403:
                throw new DomainExceptions\ForbiddenException();
            case 404:
                throw new DomainExceptions\NotFoundException();
            case 406:
                throw new DomainExceptions\ClientException('Wrong Accept headers');
            case 500:
                throw new DomainExceptions\ServerException();
            default:
                throw new DomainExceptions\UnknownErrorException();
        }
    }
}
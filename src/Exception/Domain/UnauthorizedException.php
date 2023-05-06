<?php
declare(strict_types=1);

namespace  RumusBin\OpenAiApiClient\Exception\Domain;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class UnauthorizedException extends ClientException
{
    public function __construct($message = 'Unauthorized. Please check your API key.')
    {
        $decodedMessage = json_decode($message, true);
        parent::__construct($decodedMessage['message'] ?? '');
    }
}

<?php
declare(strict_types=1);

namespace  RumusBin\OpenAiApiClient\Exception\Domain;

use  RumusBin\OpenAiApiClient\Exception\DomainException;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class ServerException extends \Exception implements DomainException
{
}

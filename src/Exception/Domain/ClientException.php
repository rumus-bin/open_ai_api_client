<?php
declare(strict_types=1);

namespace  RumusBin\OpenAiApiClient\Exception\Domain;

use  RumusBin\OpenAiApiClient\Exception\DomainException;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class ClientException extends \Exception implements DomainException
{
}

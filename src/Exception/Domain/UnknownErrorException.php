<?php
declare(strict_types=1);

namespace  RumusBin\OpenAiApiClient\Exception\Domain;

use  RumusBin\OpenAiApiClient\Exception\DomainException;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class UnknownErrorException extends \Exception implements DomainException
{
}

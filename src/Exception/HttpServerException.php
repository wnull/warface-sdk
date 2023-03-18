<?php

declare(strict_types=1);

namespace Wnull\Warface\Exception;

use Fig\Http\Message\StatusCodeInterface;
use RuntimeException;
use Throwable;
use Wnull\Warface\ExceptionInterface;

final class HttpServerException extends RuntimeException implements ExceptionInterface
{
    public static function serverError(int $httpStatus = StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR): self
    {
        return new self(
            'An unexpected error occurred at server. Try again later.',
            $httpStatus,
        );
    }

    public static function networkError(Throwable $previous): self
    {
        return new self(
            'Servers are currently unreachable.',
            0,
            $previous,
        );
    }
}

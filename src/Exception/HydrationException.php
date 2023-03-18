<?php

declare(strict_types=1);

namespace Wnull\Warface\Exception;

use RuntimeException;
use Wnull\Warface\ExceptionInterface;

final class HydrationException extends RuntimeException implements ExceptionInterface
{
}

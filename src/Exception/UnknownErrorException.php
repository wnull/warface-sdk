<?php

declare(strict_types=1);

namespace Wnull\Warface\Exception;

use Exception;
use Wnull\Warface\ExceptionInterface;

final class UnknownErrorException extends Exception implements ExceptionInterface
{
}

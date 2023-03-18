<?php

declare(strict_types=1);

namespace Wnull\Warface\Hydrator;

use Psr\Http\Message\ResponseInterface;
use Wnull\Warface\Exception\HydrationException;

interface HydratorInterface
{
    /**
     * @param class-string|string $class
     * @return array|mixed
     * @throws HydrationException
     */
    public function hydrate(ResponseInterface $response, string $class);
}

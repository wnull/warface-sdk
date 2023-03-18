<?php

declare(strict_types=1);

namespace Wnull\Warface\Hydrator;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Wnull\Warface\Exception\HydrationException;

use function json_decode;
use function sprintf;

use const JSON_THROW_ON_ERROR;

class ArrayHydrator implements HydratorInterface
{
    /**
     * @return array|mixed
     */
    public function hydrate(ResponseInterface $response, string $class)
    {
        $contentType = $response->getHeaderLine('Content-Type');
        if (!str_contains($contentType, 'application/json')) {
            throw new HydrationException(
                sprintf('The %s cannot hydrate response with content type: %s.', __CLASS__, $contentType)
            );
        }

        try {
            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new HydrationException(
                sprintf('Error (%d) when trying to json_decode response', $e->getMessage())
            );
        }
    }
}

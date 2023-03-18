<?php

declare(strict_types=1);

namespace Wnull\Warface\Hydrator;

use Psr\Http\Message\ResponseInterface;

class ModelHydrator implements HydratorInterface
{
    /**
     * @return array|mixed
     */
    public function hydrate(ResponseInterface $response, string $class)
    {
        // TODO: Implement hydrate() method.
        return null;
    }
}

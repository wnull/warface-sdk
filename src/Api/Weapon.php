<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Wnull\Warface\ExceptionInterface;

class Weapon extends AbstractApi
{
    /**
     * This method returns a complete list of items available in the game, with their id and name.
     *
     * @return array|mixed
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    public function catalog()
    {
        $response = $this->httpGet('weapon/catalog');

        return $this->hydrateResponse($response, '');
    }
}

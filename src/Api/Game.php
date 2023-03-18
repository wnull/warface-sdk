<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Wnull\Warface\ExceptionInterface;

final class Game extends AbstractApi
{
    /**
     * This method returns detailed information about available missions and rewards for completing.
     *
     * @return array|mixed
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    public function missions()
    {
        $response = $this->httpGet('game/missions');

        return $this->hydrateResponse($response, '');
    }
}

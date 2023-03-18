<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Webmozart\Assert\Assert;
use Wnull\Warface\ExceptionInterface;

use function compact;

final class User extends AbstractApi
{
    /**
     * This method returns player statistics.
     *
     * @return array|mixed
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    public function achievements(string $name)
    {
        Assert::stringNotEmpty($name);

        $response = $this->httpGet('user/achievements', compact('name'));

        return $this->hydrateResponse($response, '');
    }

    /**
     * This method returns player's achievements.
     *
     * @return array|mixed
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    public function stat(string $name)
    {
        Assert::stringNotEmpty($name);

        $response = $this->httpGet('user/stat', compact('name'));

        return $this->hydrateResponse($response, '');
    }
}

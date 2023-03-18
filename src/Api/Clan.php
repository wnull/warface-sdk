<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Webmozart\Assert\Assert;
use Wnull\Warface\ExceptionInterface;

use function compact;

final class Clan extends AbstractApi
{
    /**
     * This method returns information about the clan.
     *
     * @return array|mixed
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    public function members(string $clan)
    {
        Assert::stringNotEmpty($clan);

        $response = $this->httpGet('clan/members', compact('clan'));

        return $this->hydrateResponse($response, '');
    }
}

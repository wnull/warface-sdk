<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Wnull\Warface\Api\Clan;
use Wnull\Warface\ExceptionInterface;

/** @uses TestCase::getApi() */
beforeEach(fn () => $this->apiClass = Clan::class);

it(
    'can request a clan members',
    /**
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    function () {
        /** @var Clan $api */
        $api = $this->getApi();

        $clan = '1337';
        $element = $api->members($clan);

        expect($element)
            ->toHaveKey('id')
            ->toHaveKey('name', $clan)
            ->toHaveKey('members');
    }
);

<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Wnull\Warface\Api\Game;
use Wnull\Warface\ExceptionInterface;

/** @uses TestCase::getApi() */
beforeEach(fn () => $this->apiClass = Game::class);

it(
    'can request a game missions',
    /**
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    function () {
        /** @var Game $api */
        $api = $this->getApi();

        /** @uses TestCase::getRandomElement $element */
        $element = $this->getRandomElement($api->missions());

        expect($element)
            ->toHaveKey('game_mode')
            ->toHaveKey('name')
            ->toHaveKey('mission_type');
    }
);

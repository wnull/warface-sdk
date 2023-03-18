<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Wnull\Warface\Api\Rating;
use Wnull\Warface\Enum\GameClass;
use Wnull\Warface\Enum\RatingLeague;
use Wnull\Warface\ExceptionInterface;

/** @uses TestCase::getApi() */
beforeEach(fn () => $this->apiClass = Rating::class);

it(
    'can request a rating clan',
    /**
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    function () {
        /** @var Rating $api */
        $api = $this->getApi();

        /** @uses TestCase::getRandomElement $element */
        $element = $this->getRandomElement($api->clan());

        expect($element)
            ->toHaveKey('clan')
            ->toHaveKey('clan_leader')
            ->toHaveKey('points')
            ->toHaveKey('rank');
    }
);

it(
    'can request a rating monthly',
    /**
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    function () {
        /** @var Rating $api */
        $api = $this->getApi();

        $league = RatingLeague::ELITE();
        /** @uses TestCase::getRandomElement $element */
        $element = $this->getRandomElement($api->monthly('', $league));

        expect($element)
            ->toHaveKey('clan')
            ->toHaveKey('clan_leader')
            ->toHaveKey('members')
            ->toHaveKey('points')
            ->toHaveKey('rank')
            ->toHaveKey('rank_change');
    }
);

it(
    'can request a rating top100',
    /**
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    function () {
        /** @var Rating $api */
        $api = $this->getApi();

        $class = GameClass::SNIPER();
        /** @uses TestCase::getRandomElement $element */
        $element = $this->getRandomElement($api->top100($class));

        expect($element)
            ->toHaveKey('nickname')
            ->toHaveKey('clan')
            ->toHaveKey('class', $class->getValue())
            ->toHaveKey('shard');
    }
);

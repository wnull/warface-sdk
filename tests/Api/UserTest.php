<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Wnull\Warface\Api\User;
use Wnull\Warface\ExceptionInterface;

/** @uses TestCase::getApi() */
beforeEach(fn () => $this->apiClass = User::class);

it(
    'can request a user stat',
    /**
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    function () {
        /** @var User $api */
        $api = $this->getApi();

        $name = 'sixin';
        $element = $api->stat($name);

        expect($element)
            ->toHaveKey('user_id')
            ->toHaveKey('nickname', $name)
            ->toHaveKey('experience')
            ->toHaveKey('rank_id')
            ->toHaveKey('is_transparent')
            ->toHaveKey('kill')
            ->toHaveKey('friendly_kills')
            ->toHaveKey('kills')
            ->toHaveKey('death')
            ->toHaveKey('pvp')
            ->toHaveKey('pve_kill')
            ->toHaveKey('pve_friendly_kills')
            ->toHaveKey('pve_kills')
            ->toHaveKey('pve_death')
            ->toHaveKey('pve')
            ->toHaveKey('playtime')
            ->toHaveKey('playtime_h')
            ->toHaveKey('playtime_m')
            ->toHaveKey('favoritPVP')
            ->toHaveKey('favoritPVE')
            ->toHaveKey('pve_wins')
            ->toHaveKey('pvp_wins')
            ->toHaveKey('pvp_lost')
            ->toHaveKey('pve_lost')
            ->toHaveKey('pve_all')
            ->toHaveKey('pvp_all')
            ->toHaveKey('pvpwl')
            ->toHaveKey('full_response');
    }
);

it(
    'can request a user achievements',
    /**
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    function () {
        /** @var User $api */
        $api = $this->getApi();

        $name = 'sixin';
        /** @uses TestCase::getRandomElement $element */
        $element = $this->getRandomElement($api->achievements($name));

        expect($element)
            ->toHaveKey('achievement_id')
            ->toHaveKey('progress')
            ->toHaveKey('completion_time');
    }
);

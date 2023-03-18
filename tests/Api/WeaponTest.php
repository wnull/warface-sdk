<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Wnull\Warface\Api\Weapon;
use Wnull\Warface\ExceptionInterface;

/** @uses TestCase::getApi() */
beforeEach(fn () => $this->apiClass = Weapon::class);

it(
    'can request a weapon catalog',
    /**
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    function () {
        /** @var Weapon $api */
        $api = $this->getApi();

        /** @uses TestCase::getRandomElement $element */
        $element = $this->getRandomElement($api->catalog());

        expect($element)
            ->toHaveKey('id')
            ->toHaveKey('name_en')
            ->toHaveKey('name_es')
            ->toHaveKey('name_pl')
            ->toHaveKey('name_de')
            ->toHaveKey('name_fr')
            ->toHaveKey('name_cn')
            ->toHaveKey('name_ko')
            ->toHaveKey('name_pt')
            ->toHaveKey('name_tr');
    }
);

<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests;

use Wnull\Warface\Api\Achievement;
use Wnull\Warface\Api\Clan;
use Wnull\Warface\Api\Game;
use Wnull\Warface\Api\Rating;
use Wnull\Warface\Api\User;
use Wnull\Warface\Api\Weapon;
use Wnull\Warface\Client;

it('gets instances from the client', function () {
    $client = new Client();

    expect($client->achievement())->toBeInstanceOf(Achievement::class)
    ->and($client->clan())->toBeInstanceOf(Clan::class)
        ->and($client->game())->toBeInstanceOf(Game::class)
        ->and($client->rating())->toBeInstanceOf(Rating::class)
        ->and($client->user())->toBeInstanceOf(User::class)
        ->and($client->weapon())->toBeInstanceOf(Weapon::class);
});

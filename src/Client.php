<?php

declare(strict_types=1);

namespace Wnull\Warface;

use Psr\Http\Client\ClientInterface;
use Wnull\Warface\Api\Achievement;
use Wnull\Warface\Api\Clan;
use Wnull\Warface\Api\Game;
use Wnull\Warface\Api\Rating;
use Wnull\Warface\Api\User;
use Wnull\Warface\Api\Weapon;
use Wnull\Warface\HttpClient\HttpClientConfigurator;
use Wnull\Warface\HttpClient\RequestBuilder;
use Wnull\Warface\Hydrator\ArrayHydrator;
use Wnull\Warface\Hydrator\HydratorInterface;

final class Client
{
    protected HydratorInterface $hydrator;
    protected ClientInterface $httpClient;
    protected RequestBuilder $requestBuilder;

    public function __construct(
        HttpClientConfigurator $configurator = null,
        HydratorInterface $hydrator = null,
        RequestBuilder $requestBuilder = null
    )
    {
        $this->requestBuilder = $requestBuilder ?? new RequestBuilder();
        $this->hydrator = $hydrator ?? new ArrayHydrator();
        $this->httpClient = ($configurator ?? new HttpClientConfigurator())->createConfiguredClient();
    }

    public static function create(HttpClientConfigurator $configurator = null): self
    {
        return new self($configurator ?? new HttpClientConfigurator());
    }

    public function achievement(): Achievement
    {
        return new Achievement($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function clan(): Clan
    {
        return new Clan($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function game(): Game
    {
        return new Game($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function rating(): Rating
    {
        return new Rating($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function user(): User
    {
        return new User($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function weapon(): Weapon
    {
        return new Weapon($this->httpClient, $this->requestBuilder, $this->hydrator);
    }
}

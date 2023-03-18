<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

final class RequestBuilder
{
    private ?RequestFactoryInterface $requestFactory;

    public function create(string $method, string $uri): RequestInterface
    {
        return $this->createRequest($method, $uri);
    }

    public function setRequestFactory(RequestFactoryInterface $requestFactory): self
    {
        $this->requestFactory = $requestFactory;

        return $this;
    }

    private function getRequestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
    }

    private function createRequest(string $method, string $uri): RequestInterface
    {
        return $this->getRequestFactory()->createRequest($method, $uri);
    }
}

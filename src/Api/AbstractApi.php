<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Fig\Http\Message\RequestMethodInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Wnull\Warface\Client;
use Wnull\Warface\Enum\EntityList;
use Wnull\Warface\Exception\ApiResponseErrorException;
use Wnull\Warface\Exception\WarfaceApiException;
use Wnull\Warface\HttpClient\Message\ResponseMediator;
use Wnull\Warface\HttpClient\Message\ResponseMediatorInterface;

abstract class AbstractApi
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    abstract protected function entity(): EntityList;

    /**
     * @param array<string, mixed> $params
     * @return array<string|int, mixed>
     * @throws WarfaceApiException
     */
    protected function getByMethod(string $method, array $params = []): array
    {
        $path = $this->entity()->getValue() . '/' . $method;

        return $this->get($path, $params)->getBodyContentsDecode();
    }

    /**
     * @param array<string, mixed> $parameters
     * @throws WarfaceApiException
     */
    protected function get(string $path, array $parameters): ResponseMediatorInterface
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        return $this->sendRequest(RequestMethodInterface::METHOD_GET, $path);
    }

    /**
     * @throws WarfaceApiException
     */
    private function sendRequest(string $method, string $uri): ResponseMediatorInterface
    {
        try {
            return new ResponseMediator(
                $this->client->getHttpClient()->send($method, $uri)
            );
        } catch (ClientExceptionInterface $e) {
            throw new ApiResponseErrorException($e->getMessage(), $e->getCode());
        }
    }
}

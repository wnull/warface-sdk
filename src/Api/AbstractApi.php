<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Wnull\Warface\Exception\HttpClientException;
use Wnull\Warface\Exception\HttpServerException;
use Wnull\Warface\Exception\UnknownErrorException;
use Wnull\Warface\ExceptionInterface;
use Wnull\Warface\HttpClient\RequestBuilder;
use Wnull\Warface\Hydrator\HydratorInterface;

use function count;
use function http_build_query;

abstract class AbstractApi
{
    protected ClientInterface $httpClient;
    protected HydratorInterface $hydrator;
    protected RequestBuilder $requestBuilder;

    public function __construct(
        ClientInterface   $httpClient,
        RequestBuilder    $requestBuilder,
        HydratorInterface $hydrator
    )
    {
        $this->httpClient = $httpClient;
        $this->requestBuilder = $requestBuilder;
        $this->hydrator = $hydrator;
    }

    /**
     * @param array<int|string, mixed> $parameters
     * @throws ClientExceptionInterface
     */
    protected function httpGet(string $path, array $parameters = []): ResponseInterface
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        try {
            $response = $this->httpClient->sendRequest(
                $this->requestBuilder->create(RequestMethodInterface::METHOD_GET, $path)
            );
        } catch (NetworkExceptionInterface $e) {
            throw HttpServerException::networkError($e);
        }

        return $response;
    }

    /**
     * @return array|mixed
     * @throws ExceptionInterface
     */
    protected function hydrateResponse(ResponseInterface $response, string $class)
    {
        if ($response->getStatusCode() !== StatusCodeInterface::STATUS_OK) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, $class);
    }

    /**
     * @throws ExceptionInterface
     */
    protected function handleErrors(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();
        switch ($statusCode) {
            case StatusCodeInterface::STATUS_BAD_REQUEST:
                throw HttpClientException::badRequest($response);
            case StatusCodeInterface::STATUS_UNAUTHORIZED:
                throw HttpClientException::unauthorized($response);
            case StatusCodeInterface::STATUS_PAYMENT_REQUIRED:
                throw HttpClientException::requestFailed($response);
            case StatusCodeInterface::STATUS_NOT_FOUND:
                throw HttpClientException::notFound($response);
            case StatusCodeInterface::STATUS_TOO_MANY_REQUESTS:
                throw HttpClientException::tooManyRequests($response);
            case StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR <= $statusCode:
                throw HttpServerException::serverError($statusCode);
            default:
                throw new UnknownErrorException();
        }
    }
}

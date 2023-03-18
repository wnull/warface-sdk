<?php

declare(strict_types=1);

namespace Wnull\Warface\Exception;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Wnull\Warface\ExceptionInterface;

use function json_decode;
use function str_contains;

final class HttpClientException extends RuntimeException implements ExceptionInterface
{
    private ?ResponseInterface $response;

    /**
     * @var array<string, mixed>
     */
    private array $responseBody;
    private int $responseCode;

    public function __construct(string $message, int $code, ResponseInterface $response)
    {
        parent::__construct($message, $code);

        $this->response = $response;
        $this->responseCode = $response->getStatusCode();

        $body = $response->getBody()->getContents();
        if (str_contains($response->getHeaderLine('Content-Type'), 'application/json')) {
            $this->responseBody = (array)json_decode($body, true);
        } else {
            $this->responseBody['message'] = $body;
        }
    }

    public static function badRequest(ResponseInterface $response): self
    {
        return new self(
            'The parameters passed to the API were invalid.',
            StatusCodeInterface::STATUS_BAD_REQUEST,
            $response,
        );
    }

    public static function requestFailed(ResponseInterface $response): self
    {
        return new self(
            'Parameters were valid but request failed. Try again.',
            StatusCodeInterface::STATUS_PAYMENT_REQUIRED,
            $response,
        );
    }

    public static function unauthorized(ResponseInterface $response): self
    {
        return new self(
            'Your credentials are incorrect.',
            StatusCodeInterface::STATUS_UNAUTHORIZED,
            $response
        );
    }

    public static function notFound(ResponseInterface $response): self
    {
        return new self(
            'The endpoint you have tried to access does not exist.',
            StatusCodeInterface::STATUS_NOT_FOUND,
            $response,
        );
    }

    public static function tooManyRequests(ResponseInterface $response): self
    {
        return new self(
            'Too many requests.',
            StatusCodeInterface::STATUS_TOO_MANY_REQUESTS,
            $response
        );
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return array<string, mixed>
     */
    public function getResponseBody(): array
    {
        return $this->responseBody;
    }

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }
}

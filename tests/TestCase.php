<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests;

use Wnull\Warface\Api\AbstractApi;
use Wnull\Warface\Enum\RegionEnum;
use Wnull\Warface\HttpClient\HttpClientConfigurator;
use Wnull\Warface\HttpClient\RequestBuilder;
use Wnull\Warface\Hydrator\ArrayHydrator;

use function array_rand;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var class-string<AbstractApi>
     */
    protected string $apiClass;

    public function getApi(): AbstractApi
    {
        $httpClient = (new HttpClientConfigurator())
            ->setRegion(RegionEnum::INTERNATIONAL())
            ->createConfiguredClient();

        return new $this->apiClass($httpClient, new RequestBuilder(), new ArrayHydrator());
    }

    protected function getRandomElement(array $data): ?array
    {
        return $data[array_rand($data)] ?? null;
    }
}

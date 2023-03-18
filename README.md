# Warface  SDK client

[![Build Status](https://travis-ci.com/wnull/warface-sdk.svg?branch=main)](https://travis-ci.com/brefphp/bref)
[![Latest Version](https://img.shields.io/github/release/wnull/warface-sdk.svg)](https://packagist.org/packages/wnull/warface-sdk)

Fast and flexible SDK client of the Warface API in PHP.

> During technical weekly work on the game servers, the API may work unstable and give incorrect data.

## Requirements

- PHP >= 7.4
- A [PSR-17 implementation](https://packagist.org/providers/psr/http-factory-implementation)
- A [PSR-18 implementation](https://packagist.org/providers/psr/http-client-implementation)

## References

- [Warface API documentation](https://ru.warface.com/wiki/index.php/API)

## Installation

Via Composer:

```shell
$ composer require wnull/warface-sdk
```

## Quickstart

Structure of the client class constructor.

```php
public function __construct(
    HttpClientConfigurator $configurator = null,     
    HydratorInterface $hydrator = null,     
    RequestBuilder $requestBuilder = null 
): Client
```

Create an instance of the client using the following code:

  ```php
  $client = new \Wnull\Warface\Client();
  ```

Creating and using additional client settings:

- Using the configurator class, you can configure the properties of the client class.

  ```php
  $configurator = new \Wnull\Warface\HttpClient\HttpClientConfigurator();
  ```
  - For example, to use the Symfony HTTP Client, first install the client and PSR-7 implementation.

    ```shell
    composer require wnull/warface-sdk symfony/http-client nyholm/psr7
    ```
    Next, set up the Warface SDK client with this HTTP client:

    ```php
    $configurator->setHttpClient(new \Symfony\Component\HttpClient\HttplugClient());
    ```

  - Using custom HTTP plugins:

    ```php
    $configurator->addPlugin(
        new class implements \Http\Client\Common\Plugin {
            public function handleRequest(
                \Psr\Http\Message\RequestInterface $request, 
                callable $next, 
                callable $first
            ): \Http\Promise\Promise {
                // TODO: Implement handleRequest() method.
            }
        }
    );
    ```

  - By default, the `CIS` region is set in the client. It can be changed to `INTERNATIONAL` if necessary.
    
    ```php
    $configurator->setRegion(\Wnull\Warface\Enum\RegionEnum::INTERNATIONAL());
    ```

 - Hydration is used, the client uses `ArrayHydrator` by default, the result of which will always be an array. It is possible to change the response by changing the hydrator to `ModelHydrator`.
    
   ```php
   $client = new \Wnull\Warface\Client(null, new \Wnull\Warface\Hydrator\ModelHydrator());
   ```

## API

The structure of the application is based solely on the public methods described in the official [docs](#references).

#### Achievement branch

- > Method `catalog` returns a complete list of achievements available in the game, with their id and name.

  ```php
  $catalog = (new \Wnull\Warface\Client())->achievement()->catalog();
  ```

#### Clan branch

- > Method `members` returns information about the clan.

  ```php
  $members = (new \Wnull\Warface\Client())->clan()->members('<clan>');
  ```

#### Game branch

- > Method `missions` returns detailed information about available missions and rewards for completing.

  ```php
  $missions = (new \Wnull\Warface\Client())->game()->missions();
  ```

#### Rating branch

- > Method `monthly` returns the monthly rating.
  >
  > If the `$clan` parameter is used, the response from the server will contain data about the selected clan, it will also indicate exactly the league in which this clan is located even if it was not selected in the `$league`.
  >
  > If only the `$league` parameter is used, the server will return the top 100 for that league.

  ```php
  $monthly = (new \Wnull\Warface\Client())
    ->rating()
    ->monthly('?<clan>', \Wnull\Warface\Enum\RatingLeague::ELITE(), '?<page>');
  ```

- > Method `clan` returns information about the rating of clans.

  ```php
  $clan = (new \Wnull\Warface\Client())->rating()->clan();
  ```

- > Method `top100` returns a TOP-100 rating.
  > 
  > If the parameter `$class` is not specified, the data gets for all classes.

  ```php
  $top100 = (new \Wnull\Warface\Client())->rating()->top100(\Wnull\Warface\Enum\GameClass::MEDIC());
  ```

#### User branch

- > Method `stat` returns player statistics.

  ```php
  $stat = (new \Wnull\Warface\Client())->user()->stat('<name>');
  ```

- > Method `achievements` returns player's achievements.

  ```php
  $achievements = (new \Wnull\Warface\Client())->user()->achievements('<name>');
  ```

#### Weapon branch

- > Method `catalog` returns a complete list of items available in the game, with their id and name.

  ```php
  $catalog = (new \Wnull\Warface\Client())->achievement()->catalog();
  ```

## Testing

```shell
$ composer test
```

## Credits

- [Obraz Solntsa](https://github.com/wnull)
- [All Contributors](https://github.com/wnull/warface-sdk/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
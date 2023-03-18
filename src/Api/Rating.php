<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Wnull\Warface\Enum\GameClass;
use Wnull\Warface\Enum\RatingLeague;
use Wnull\Warface\ExceptionInterface;

use function compact;

class Rating extends AbstractApi
{
    /**
     * This method returns information about the rating of clans.
     *
     * @return array|mixed
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    public function clan()
    {
        $response = $this->httpGet('rating/clan');

        return $this->hydrateResponse($response, '');
    }

    /**
     * This method returns the monthly rating.
     *
     * If the $clan parameter is used, the response from the server will contain data about the selected clan, it will
     * also indicate exactly the league in which this clan is located even if it was not selected in the $league.
     *
     * If only the $league parameter is used, the server will return the top 100 for that league.
     *
     * @return array|mixed
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    public function monthly(?string $clan = null, ?RatingLeague $league = null, int $page = 0)
    {
        $league = ($league ?? RatingLeague::NONE())->getValue();

        $response = $this->httpGet('rating/monthly', compact('clan', 'league', 'page'));

        return $this->hydrateResponse($response, '');
    }

    /**
     * This method returns a TOP-100 rating.
     *
     * If the parameter $class is not specified or set 0, the data gets for all classes.
     *
     * @return array|mixed
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     */
    public function top100(?GameClass $class = null)
    {
        $class = ($class ?? GameClass::NONE())->getValue();

        $response = $this->httpGet('rating/top100', compact('class'));

        return $this->hydrateResponse($response, '');
    }
}

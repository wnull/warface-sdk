<?php

declare(strict_types=1);

namespace Wnull\Warface\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static RatingLeague NONE()
 * @method static RatingLeague ELITE()
 * @method static RatingLeague PLATINUM()
 * @method static RatingLeague GOLDEN()
 * @method static RatingLeague SILVER()
 * @method static RatingLeague BRONZE()
 * @method static RatingLeague STEEL()
 *
 * @extends Enum<int>
 */
final class RatingLeague extends Enum
{
    public const NONE     = 0;
    public const ELITE    = 1;
    public const PLATINUM = 2;
    public const GOLDEN   = 3;
    public const SILVER   = 4;
    public const BRONZE   = 5;
    public const STEEL    = 6;
}

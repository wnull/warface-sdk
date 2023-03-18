<?php

declare(strict_types=1);

namespace Wnull\Warface\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static GameClass NONE()
 * @method static GameClass RIFLEMAN()
 * @method static GameClass MEDIC()
 * @method static GameClass ENGINEER()
 * @method static GameClass SNIPER()
 * @method static GameClass SED()
 *
 * @extends Enum<int>
 */
final class GameClass extends Enum
{
    public const NONE     = 0;
    public const RIFLEMAN = 1;
    public const MEDIC    = 2;
    public const ENGINEER = 3;
    public const SNIPER   = 4;
    public const SED      = 5;
}

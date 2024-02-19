<?php

declare(strict_types=1);

namespace Tipoff\Seo\Enum;

use MabeEnum\Enum;

/**
 * @method static KeywordType BRANDED()
 * @method static KeywordType GENERIC()
 * @method static KeywordType LOCAL()
 * @psalm-immutable
 */
class KeywordType extends Enum
{
    const BRANDED = 'branded';
    const GENERIC = 'generic';
    const LOCAL = 'local';
}

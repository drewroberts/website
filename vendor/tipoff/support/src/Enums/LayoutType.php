<?php

declare(strict_types=1);

namespace Tipoff\Support\Enums;

/**
 * @method static LayoutType PAGE()
 * @method static LayoutType POST()
 * @method static LayoutType TOPIC()
 * @method static LayoutType SERIES()

 * @psalm-immutable
 */
class LayoutType extends BaseEnum
{
    const PAGE = 'page';
    const POST = 'post';
    const TOPIC = 'topic';
    const SERIES = 'series';
}

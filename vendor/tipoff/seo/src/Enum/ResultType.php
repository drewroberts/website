<?php

declare(strict_types=1);

namespace Tipoff\Seo\Enum;

use MabeEnum\Enum;

/**
 * @method static TaxCode ORGANIC_LISTING()
 * @method static TaxCode LOCAL_LISTING()
 * @method static TaxCode FEATURED_SNIPPET()
 * @method static TaxCode INLINE_VIDEO_LISTINGS()
 * @method static TaxCode ADS()
 * @psalm-immutable
 */
class ResultType extends Enum
{
    const ORGANIC_LISTING = 'organic_listing';
    const LOCAL_LISTING = 'local_listing';
    const FEATURED_SNIPPET = 'featured_snippet';
    const INLINE_VIDEO_LISTINGS = 'inline_video_listings';
    const ADS = 'ads';
}

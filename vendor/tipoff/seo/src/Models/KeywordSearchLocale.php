<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class KeywordSearchLocale extends Pivot
{
    use HasPackageFactory;
    use HasCreator;
    use HasUpdater;

    protected static function boot()
    {
        parent::boot();
    }
}

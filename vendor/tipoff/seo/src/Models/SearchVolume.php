<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Assert\Assert;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class SearchVolume extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;
    use HasUpdater;

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($search_volume) {
            Assert::lazy()
                ->that($search_volume->engine)->notEmpty('Search Volume must have an engine.')
                ->that($search_volume->provider)->notEmpty('Search Volume must have a provider.')
                ->that($search_volume->range)->notEmpty('Search Volume must have a range of month, week or day.')
                ->that($search_volume->range_value)->notEmpty('Search Volume must have a range value.')
                ->that($search_volume->queries)->notEmpty('Search Volume must have queries.')
                ->that($search_volume->keyword_id)->notEmpty('Search Volume must have a keyword.')
                ->verifyNow();
        });
    }

    public function keyword()
    {
        return $this->belongsTo(app('keyword'));
    }
}

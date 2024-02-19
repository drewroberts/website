<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Tipoff\Seo\Actions\Keywords\CheckAllKeywordRankings;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Ranking extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;
    use HasUpdater;

    protected $casts = [
        'date' => 'date',
    ];

    public static function checkAllKeywords() : void
    {
        app(CheckAllKeywordRankings::class);
    }

    public function keyword()
    {
        return $this->belongsTo(app('keyword'));
    }

    public function results()
    {
        return $this->hasMany(app('result'));
    }

    public function searchLocale()
    {
        return $this->belongsTo(app('search_locale'));
    }
}

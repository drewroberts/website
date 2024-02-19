<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Illuminate\Database\Eloquent\Builder;
use Tipoff\Seo\Actions\Keywords\CheckRanking;
use Tipoff\Seo\Enum\KeywordType;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Keyword extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;
    use HasUpdater;

    protected $casts = [
        'tracking_requested_at' => 'datetime',
        'tracking_stopped_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($keyword) {
            $keyword->phrase = strtolower($keyword->phrase);
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->whereDate('keywords.tracking_requested_at', '<=', date('Y-m-d')) &&
            ($builder->whereDate('keywords.tracking_stopped_at', '>=', date('Y-m-d'))
                ->orWhereNull('keywords.tracking_stopped_at'));
        });
    }

    public function isBranded(): bool
    {
        return $this->type == KeywordType::BRANDED;
    }

    public function isGeneric(): bool
    {
        return $this->type == KeywordType::GENERIC;
    }

    public function isLocal(): bool
    {
        return $this->type == KeywordType::LOCAL;
    }

    public function getRanking(): void
    {
        app(CheckRanking::class)($this);
    }

    public function searchLocales()
    {
        return $this->belongsToMany(app('search_locale'))
            ->withTimestamps()
            ->withPivot(['creator_id', 'updater_id'])
            ->using(KeywordSearchLocale::class);
    }

    public function parent()
    {
        return $this->belongsTo(app('keyword'), 'parent_id');
    }

    public function rankings()
    {
        return $this->hasMany(app('ranking'));
    }

    public function searchVolume()
    {
        return $this->hasOne(SearchVolume::class);
    }
}

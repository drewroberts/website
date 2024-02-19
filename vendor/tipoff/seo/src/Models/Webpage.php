<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Webpage extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;
    use HasUpdater;

    public function domain()
    {
        return $this->belongsTo(app('domain'));
    }

    public function results()
    {
        return $this->morphMany(app('result'), 'resultable');
    }

    public function places()
    {
        return $this->hasMany(app('place'));
    }

    public function getFormattedTitleAttribute(): string
    {
        $result = "";
        if (! isset($this->domain) || empty($this->domain)) {
            return $this->path;
        }
        if ($this->domain->https) {
            $result .= 'https://';
        } else {
            $result .= 'http://';
        }
        if (isset($this->subdomain) && ! empty($this->subdomain)) {
            $result .= $this->subdomain . '.';
        }
        $result .= $this->domain->name . '.' . $this->domain->tld . $this->path;

        return $result;
    }

    public static function getUrlPath(string $url): ?string
    {
        $path = parse_url($url, PHP_URL_PATH);

        return $path;
    }
}

<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Domain extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;
    use HasUpdater;

    public function company()
    {
        return $this->belongsTo(app('company'));
    }

    public function getFormattedTitleAttribute(): string
    {
        $result = "";
        if ($this->https) {
            $result .= 'https://';
        } else {
            $result .= 'http://';
        }
        if (isset($this->subdomain) && ! empty($this->subdomain)) {
            $result .= $this->subdomain . '.';
        }
        $result .= $this->name . '.' . $this->tld;

        return $result;
    }
}

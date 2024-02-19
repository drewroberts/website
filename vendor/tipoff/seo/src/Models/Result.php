<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Result extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;
    use HasUpdater;

    public $timestamps = false;

    public function ranking()
    {
        return $this->belongsTo(app('ranking'));
    }

    public function parent()
    {
        return $this->belongsTo(app('result'), 'parent_id');
    }

    public function resultable()
    {
        return $this->morphTo();
    }
}

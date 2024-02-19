<?php

declare(strict_types=1);

namespace Tipoff\GoogleApi\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Key extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;

    protected $casts = [
        'value' => 'array',
    ];

    public function gmb_accounts()
    {
        return $this->hasMany(app('gmb_account'));
    }
}

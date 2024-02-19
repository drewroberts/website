<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;

class BusinessCategory extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;
    
    const UPDATED_AT = null;
}

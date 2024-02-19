<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Tipoff\Support\Contracts\Authorization\EmailAddressInterface;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

/**
 * @property int id
 * @property string email
 * @property User|null user
 * @property int|null user_id
 * @property bool primary
 * @property Carbon|null verified_at
 * @property Carbon|null undeliverable_at
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class EmailAddress extends BaseModel implements EmailAddressInterface
{
    use HasPackageFactory;
    use Authenticatable;
    use Authorizable;

    protected $casts = [
        'verified_at' => 'datetime',
        'undeliverable_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(app('user'));
    }

    public function getAuthPassword()
    {
        return '';
    }
}

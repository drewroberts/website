<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tipoff\Support\Contracts\Checkout\CartInterface;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Support\Contracts\Payment\ChargeableInterface;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

/**
 * @property int id
 * @property string first_name
 * @property string last_name
 * @property string username
 * @property string password
 * @property string remember_token
 * @property string bio
 * @property string title
 * @property string provider_name
 * @property string provider_id
 * @property string email
 * @property Carbon|null email_verified_at
 * @property Collection email_addresses
 * @property Carbon deleted_at
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class User extends BaseModel implements UserInterface, CanResetPasswordContract, ChargeableInterface
{
    use HasPackageFactory;
    use SoftDeletes;
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use Notifiable;
    use HasRoles;
    use HasApiTokens;
    use Billable;

    protected $guarded = ['id'];

    protected $casts = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (User $user) {
            $user->password = $user->password ?: bcrypt(Str::upper(Str::random(8)));
            $user->username = $user->username ?: $user->generateUsername();
        });
    }

    private function generateUsername(): string
    {
        do {
            $generic = 'user' . Str::of(Carbon::now('America/New_York')->format('ymdB'))->substr(1, 7) . Str::lower(Str::random(6));
        } while (self::where('username', $generic)->first()); //check if the generated generic username already exists and if it does, try again

        return $generic;
    }

    public function emailAddresses()
    {
        return $this->hasMany(app('email_address'));
    }

    public function getPrimaryEmailAddress(): ?EmailAddress
    {
        // TODO - sorting by primary will ensure a primary address is returned when flagged, but also handle a missing flag
        return $this->emailAddresses()
            ->orderBy('primary', 'desc')
            ->orderBy('created_at', 'asc')
            ->first();
    }

    public function locations()
    {
        return $this->belongsToMany(app('location'))->withTimestamps();
    }

    public function managedLocations()
    {
        return $this->hasMany(app('location'), 'manager_id');
    }

    public function customers()
    {
        return $this->hasMany(app('customer'));
    }

    public function participants()
    {
        return $this->hasMany(app('participant'));
    }

    public function notes()
    {
        return $this->morphMany(app('note'), 'noteable');
    }

    public function contacts()
    {
        return $this->hasMany(app('contact'));
    }

    public function posts()
    {
        return $this->hasMany(app('post'), 'author_id');
    }

    public function blocks()
    {
        return $this->hasMany(app('block'), 'creator_id');
    }

    public function notesCreated()
    {
        return $this->hasMany(app('note'), 'creator_id');
    }

    public function vouchersCreated()
    {
        return $this->hasMany(app('voucher'), 'creator_id');
    }

    public function carts()
    {
        return $this->hasMany(app('cart'));
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function toCustomer(array $attributes)
    {
        $this->assignRole('Customer');

        return $this->customers()->create($attributes);
    }

    public function getEmailAttribute()
    {
        $emailAddress = $this->getPrimaryEmailAddress();

        return $emailAddress ? $emailAddress->email : null;
    }

    public function getEmailVerifiedAtAttribute()
    {
        $emailAddress = $this->getPrimaryEmailAddress();

        return $emailAddress ? $emailAddress->verified_at : null;
    }

    /**
     * Get active cart.
     *
     * @return CartInterface|null
     */
    public function cart()
    {
        if ($service = findService(CartInterface::class)) {
            /** @var CartInterface $service */
            return $service::activeCart($this->id);
        }

        return null;
    }
}

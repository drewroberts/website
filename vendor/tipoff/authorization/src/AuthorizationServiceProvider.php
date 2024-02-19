<?php

declare(strict_types=1);

namespace Tipoff\Authorization;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Tipoff\Authorization\Models\EmailAddress;
use Tipoff\Authorization\Models\User;
use Tipoff\Authorization\Policies\PermissionPolicy;
use Tipoff\Authorization\Policies\RolePolicy;
use Tipoff\Authorization\Policies\UserPolicy;
use Tipoff\Authorization\Providers\TipoffUserProvider;
use Tipoff\Support\Contracts\Authorization\EmailAddressInterface;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class AuthorizationServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                User::class => UserPolicy::class,
            ])
            ->hasNovaResources([
                \Tipoff\Authorization\Nova\User::class,
                \Tipoff\Authorization\Nova\EmailAddress::class,
            ])
            ->hasNovaTools([
                \Vyuldashev\NovaPermission\NovaPermissionTool::make()
                    ->rolePolicy(RolePolicy::class)
                    ->permissionPolicy(PermissionPolicy::class),
            ])
            ->hasModelInterfaces([
                EmailAddressInterface::class => EmailAddress::class,
                UserInterface::class => User::class,
            ])
            ->hasWebRoute('web')
            ->name('authorization')
            ->hasViews()
            ->hasConfigFile();
    }

    public function bootingPackage()
    {
        parent::bootingPackage();

        Auth::provider('tipoff', function ($app) {
            return new TipoffUserProvider($app->make('hash'), User::class);
        });
    }

    public function registeringPackage()
    {
        Nova::booted(function () {
            // Register serving function only after Nova is booted, this should
            // ensure we are "last in line" and able to replace the default gate definition
            Nova::serving(function () {
                Gate::define('viewNova', function ($user) {
                    if ($user instanceof UserInterface) {
                        return $user->hasPermissionTo('access admin');
                    }

                    return false;
                });
            });
        });
    }
}

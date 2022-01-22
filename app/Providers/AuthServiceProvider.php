<?php

namespace App\Providers;

use App\Models\Lookup;
use App\Models\LookupType;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            $permissions = Cache::remember('users', now()->addHours(1), function () use($user) {
                return RolePermission::where('role_id', $user->role_id)->pluck('key');;
            });
            if (($permissions && in_array($ability, $permissions->toArray())) || $user->role == 'admin' || $user->role_id == 1) {
                return true;
            }
        });
    }
}

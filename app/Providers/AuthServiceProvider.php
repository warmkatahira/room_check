<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // マスタ操作有効のみ許可
        Gate::define('masterOperationIsAvailable', function($user){
            return ($user->role->master_operation_is_available == 1);
        });
        // 管理操作有効のみ許可
        Gate::define('managementOperationIsAvailable', function($user){
            return ($user->role->management_operation_is_available == 1);
        });
    }
}

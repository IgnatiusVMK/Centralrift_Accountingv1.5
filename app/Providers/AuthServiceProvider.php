<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Cycles;
use App\Models\Sales;
use App\Models\User;
use App\Policies\CyclesPolicy;
use App\Policies\SalesPolicy;
use App\Policies\UsersPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Sales::class => SalesPolicy::class,
        User::class => UsersPolicy::class,
        Cycles::class => CyclesPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('access-users', function ($user) {
            return /* $user->hasRole('Admin') || */ $user->hasPermission('access_users');
        });
        Gate::define('view-users', function ($user) {
            return  $user->hasPermission('view_users');
        });
        Gate::define('create-users', function ($user) {
            return  $user->hasPermission('create_users');
        });
        Gate::define('edit-users', function ($user) {
            return  $user->hasPermission('edit_users');
        });
        Gate::define('view-master', function ($user) {
            return  $user->hasPermission('view_master');
        });
        Gate::define('access-cycles', function ($user) {
            return  $user->hasPermission('access_cycles');
        });
        Gate::define('view-cycles', function ($user) {
            return  $user->hasPermission('view_cycles');
        });
        Gate::define('create-cycles', function ($user) {
            return  $user->hasPermission('create_cycles');
        });
        Gate::define('view-finance', function ($user) {
            return  $user->hasPermission('view_finance');
        });
        Gate::define('view-purchases', function ($user) {
            return  $user->hasPermission('view_purchases');
        }); 
        Gate::define('view-sales', function ($user) {
            return  $user->hasPermission('view_sales');
        });  
        Gate::define('view-financials', function ($user) {
            return   $user->hasPermission('view_financials');
        });  
        Gate::define('view-reports', function ($user) {
            return  $user->hasPermission('view_reports');
        });  
        

        
    }
}

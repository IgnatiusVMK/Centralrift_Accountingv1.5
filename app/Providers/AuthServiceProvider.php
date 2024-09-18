<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Cycles;
use App\Models\Sales;
use App\Models\User;
use App\Policies\CheckerPolicy;
use App\Policies\CyclesPolicy;
use App\Policies\MakerPolicy;
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
        User::class => CheckerPolicy::class,
        User::class => MakerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //UserModel
        Gate::define('access-users', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_users');
        });
        Gate::define('view-users', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_users');
        });
        Gate::define('create-users', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_users');
        });
        Gate::define('modify-users', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('modify_users');
        });
        Gate::define('delete-users', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('delete_users');
        });

        //Checker
        Gate::define('access-approval', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_approval');
        });
        Gate::define('view-approval', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_approval');
        });
        Gate::define('create-approval', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_approval');
        });
        //Maker
        Gate::define('access-maker', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_maker');
        });
        Gate::define('view-maker', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_maker');
        });
        Gate::define('create-maker', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_maker');
        });
        
        //CyclesModel
        Gate::define('access-cycles', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_cycles');
        });
        Gate::define('view-cycles', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_cycles');
        });
        Gate::define('create-cycles', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_cycles');
        });

        //RolesModel
        Gate::define('access-roles', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_roles');
        });
        Gate::define('view-roles', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_roles');
        });
        Gate::define('create-roles', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_roles');
        });
        //PermissionsModel
        Gate::define('access-permissions', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_permissions');
        });
        Gate::define('view-permissions', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_permissions');
        });
        Gate::define('create-permissions', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_permissions');
        });

        //Master Operation
        Gate::define('access-master', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_master');
        });
        Gate::define('view-master', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_master');
        });
        Gate::define('create-master', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_master');
        });
        Gate::define('modify-master', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('modify_master');
        });
        Gate::define('delete-master', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('delete_master');
        });

        //Customers
        Gate::define('access-customers', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_customers');
        });
        Gate::define('view-customers', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_customers');
        });
        Gate::define('create-customers', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_customers');
        });
        Gate::define('modify-customers', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('modify_customers');
        });
        Gate::define('delete-customers', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('delete_customers');
        });

        //ExpensesModel
        Gate::define('access-financials', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_financials');
        });  
        Gate::define('view-financials', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_financials');
        });  
        Gate::define('create-financials', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_financials');
        });  
        Gate::define('modify-financials', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('modify_financials');
        });  
        Gate::define('delete-financials', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('delete_financials');
        });  

        //PurchaseModel
        Gate::define('access-purchases', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_purchases');
        }); 
        Gate::define('view-purchasess', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_purchases');
        });
        Gate::define('create-purchases', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_purchases');
        });
        Gate::define('modify-purchases', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('modify_purchases');
        });
        Gate::define('delete-purchases', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('delete_purchases');
        });

        //SalesModel
        Gate::define('access-sales', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_sales');
        }); 
        Gate::define('view-sales', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_sales');
        });
        Gate::define('create-sales', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_sales');
        });
        Gate::define('modify-sales', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('modify_sales');
        });
        Gate::define('delete-sales', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('delete_sales');
        });

        //FinanceModel (Cashbook, P&L)
        Gate::define('access-finance', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_finance');
        });
        Gate::define('view-finance', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_finance');
        });
        Gate::define('create-finance', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_finance');
        });
        Gate::define('modify-finance', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('modify_finance');
        });
        Gate::define('delete-finance', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('delete_finance');
        });

        //ReportsView
        Gate::define('access-reports', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_reports');
        });
        Gate::define('view-reports', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_reports');
        });
        Gate::define('create-reports', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_reports');
        });
        
        //System Maintenance
        Gate::define('access-maintenance', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('access_maintenance');
        });
        Gate::define('view-maintenance', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('view_maintenance');
        });
        Gate::define('create-maintenance', function ($user) {
            return $user->hasRole('Admin') || $user->hasPermission('create_maintenance');
        });
        
    }
}

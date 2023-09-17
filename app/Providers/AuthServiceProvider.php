<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    protected $my_gates = [
        'is-admin' => 'App\Gates\DashboardGate',
    ];


    public function registerGates()
    {
        Gate::define('role', function($user) {
            return $user->role;
        });
    }

    public function boot()
    {
        $this->registerPolicies();
        $this->registerGates();
    }
}

<?php

namespace App\Providers;

use App\Policies\TrainingPolicy;
use App\Training;
use App\User;
use App\Colloquium;
use App\Policies\UserPolicy;
use App\Policies\ColloquiumPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Colloquium::class => ColloquiumPolicy::class,
        User::class => UserPolicy::class,
        Training::class => TrainingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

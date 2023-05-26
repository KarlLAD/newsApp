<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // nom de autorisation pour admin === 1
        // admin c'est la colonne de la base user
        Gate::define('admin', function (User $user) { // admin est nom de autorisation
                    return $user->admin === 1;
                });

// véfifie s'il est majeur

        Gate::define('majeur', function (User $user) {
        $age = date('y') - intval(substr($user->datenais,4,4));
            return $age >= 18 ;
                });
     // gestion abonnement
     Gate::define('abonnement', function (User $user) { 
        return date("Y-m-d H:i:s") <=$user->abonnement;

    });   

    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Gate::define('ultraman', function ($user) {
            return $user->hasAnyRole('99');
        });

        Gate::define('it', function ($user){
            return $user->hasAnyRoles(['98','99']);
        });

        Gate::define('Panitia', function ($user){
            return $user->hasAnyRoles(['98','99', '1', '2', '3','7']);
        });

        Gate::define('koc', function ($user){
            return $user->hasAnyRoles(['99', '1']);
        });

        Gate::define('admin', function ($user){
            return $user->hasAnyRoles(['99', '2']);
        });

        Gate::define('materi', function ($user){
            return $user->hasAnyRoles(['99', '3']);
        });

        Gate::define('mhs', function ($user){
            return $user->hasAnyRoles(['99', '4']);
        });

        Gate::define('penguji', function ($user){
            return $user->hasAnyRoles(['99', '5']);
        });
        Gate::define('ps', function ($user){
            return $user->hasAnyRoles(['99', '6']);
        });
        Gate::define('pps', function ($user){
            return $user->hasAnyRoles(['99', '7']);
        });
    }


}

<?php

namespace App\Providers;

use App\Models\DemandeColi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.sidebar', function ($view)
        {
            $demande_traite = DemandeColi::where('etat','traite')->get()->count();
            $demande_encours = DemandeColi::where('etat','encours')->get()->count();

            $view->with('demande_traite',$demande_traite);
            $view->with('demande_encours',$demande_encours);
        });

        DB::listen(function($query) {
            $sql = $query->sql;
            // print($sql . "-//-");
            $bindings = $query->bindings;
            $executionTime = $query->time;
        });

        Schema::defaultStringLength(191);
    }
}

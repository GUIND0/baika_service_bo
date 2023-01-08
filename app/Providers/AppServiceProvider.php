<?php

namespace App\Providers;

use App\Models\DemandeColi;
use App\Models\DemandeTaxi;
use App\Models\GetAutomobile;
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
            $demande_rejete = DemandeColi::where('etat','rejete')->get()->count();

            $view->with('demande_traite',$demande_traite);
            $view->with('demande_encours',$demande_encours);
            $view->with('demande_rejete',$demande_rejete);

            $demande_taxi_traite = DemandeTaxi::where('etat','traite')->get()->count();
            $demande_taxi_encours = DemandeTaxi::where('etat','encours')->get()->count();
            $demande_taxi_rejete = DemandeTaxi::where('etat','rejete')->get()->count();

            $view->with('demande_taxi_traite',$demande_taxi_traite);
            $view->with('demande_taxi_encours',$demande_taxi_encours);
            $view->with('demande_taxi_rejete',$demande_taxi_rejete);

            $demande_auto_traite = GetAutomobile::where('etat','traite')->get()->count();
            $demande_auto_encours = GetAutomobile::where('etat','encours')->get()->count();
            $demande_auto_rejete = GetAutomobile::where('etat','rejete')->get()->count();

            $view->with('demande_auto_traite',$demande_auto_traite);
            $view->with('demande_auto_encours',$demande_auto_encours);
            $view->with('demande_auto_rejete',$demande_auto_rejete);
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

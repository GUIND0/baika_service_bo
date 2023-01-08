<?php

namespace App\Http\Controllers;

use App\Models\DemandeTaxi;
use App\Models\Quartier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemandeTaxiController extends Controller
{
    public function encours()
    {

        $demande_taxi_encours = DemandeTaxi::select(
            DB::raw('demande_taxis.*'),
            )
        ->where('demande_taxis.etat','encours')
        ->orderByDesc('created_at')
        ->get();

        $demande_taxi_encours->map(function ($item) {
            $item->depart = Quartier::where('id', '=', $item->departs_id)->pluck('libelle')->first();
            $item->arrive = Quartier::where('id', '=', $item->arrives_id)->pluck('libelle')->first();

            return $item;
        });
        return view('pages.demande_taxis.encour', compact('demande_taxi_encours'));
    }

    public function traite()
    {

        $demande_taxi_traite = DemandeTaxi::select(
            DB::raw('demande_taxis.*'),
            DB::raw("CONCAT(users.nom,' ',users.prenom) as user"),
            )
        ->where('demande_taxis.etat','traite')
        ->leftJoin('users','users.id','demande_taxis.users_id')
        ->orderByDesc('created_at')
        ->get();

        $demande_taxi_traite->map(function ($item) {
            $item->depart = Quartier::where('id', '=', $item->departs_id)->pluck('libelle')->first();
            $item->arrive = Quartier::where('id', '=', $item->arrives_id)->pluck('libelle')->first();

            return $item;
        });

        return view('pages.demande_taxis.traite', compact('demande_taxi_traite'));
    }

    public function rejete()
    {

        $demande_taxi_rejete = DemandeTaxi::select(
            DB::raw('demande_taxis.*'),

            DB::raw("CONCAT(users.nom,' ',users.prenom) as user"),
            )
        ->where('demande_taxis.etat','rejete')
        ->leftJoin('users','users.id','demande_taxis.users_id')
        ->orderByDesc('created_at')
        ->get();

        $demande_taxi_rejete->map(function ($item) {
            $item->depart = Quartier::where('id', '=', $item->departs_id)->pluck('libelle')->first();
            $item->arrive = Quartier::where('id', '=', $item->arrives_id)->pluck('libelle')->first();

            return $item;
        });

        return view('pages.demande_taxis.rejete', compact('demande_taxi_rejete'));
    }

    public function demande_change_etat($id){
        $demande = DemandeTaxi::find($id);
        if($demande){
            $demande->etat = request('etat');
            $demande->users_id = auth()->user()->id;
            if($demande->save()){
                flash()->success('Succès  !', 'Demande taxi Mise a jour  avec succès');
                return 'ok';
            }
        }

    }
}

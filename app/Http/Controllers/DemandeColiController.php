<?php

namespace App\Http\Controllers;

use App\Models\DemandeColi;
use App\Models\Quartier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemandeColiController extends Controller
{
    public function encours()
    {

        $colis_livraison_encours = DemandeColi::select(
            DB::raw('demande_colis.*'),
            DB::raw('type_colis.libelle as colis'),
            )
        ->where('demande_colis.etat','encours')
        ->leftJoin('type_colis','type_colis.id','demande_colis.type_colis_id')
        ->orderByDesc('created_at')
        ->get();

        $colis_livraison_encours->map(function ($item) {
            $item->depart = Quartier::where('id', '=', $item->departs_id)->pluck('libelle')->first();
            $item->arrive = Quartier::where('id', '=', $item->arrives_id)->pluck('libelle')->first();

            return $item;
        });
        return view('pages.colis_livraisons.encour', compact('colis_livraison_encours'));
    }

    public function traite()
    {

        $colis_livraison_traite = DemandeColi::select(
            DB::raw('demande_colis.*'),
            DB::raw('type_colis.libelle as colis'),
            )
        ->where('demande_colis.etat','traite')
        ->leftJoin('type_colis','type_colis.id','demande_colis.type_colis_id')
        ->orderByDesc('created_at')
        ->get();

        $colis_livraison_traite->map(function ($item) {
            $item->depart = Quartier::where('id', '=', $item->departs_id)->pluck('libelle')->first();
            $item->arrive = Quartier::where('id', '=', $item->arrives_id)->pluck('libelle')->first();

            return $item;
        });

        return view('pages.colis_livraisons.traite', compact('colis_livraison_traite'));
    }

    public function demande_change_etat($id){
        $demande = DemandeColi::find($id);
        if($demande){
            $demande->etat = request('etat');

            if($demande->save()){
                flash()->success('Succès  !', 'Demande Mise a jour  avec succès');
                return back();
            }
        }

    }
}

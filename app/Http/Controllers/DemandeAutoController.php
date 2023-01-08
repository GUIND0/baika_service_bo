<?php

namespace App\Http\Controllers;

use App\Models\GetAutomobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemandeAutoController extends Controller
{
    public function encours()
    {

        $demande_auto_encours = GetAutomobile::select(
            DB::raw('get_automobiles.*'),
            DB::raw("CONCAT(type_auto.libelle,' : ',automobiles.caracteristique) as automobile"),
            )
        ->leftJoin('automobiles','automobiles.id','get_automobiles.automobiles_id')
        ->leftJoin('type_auto','type_auto.id','automobiles.type_auto_id')
        ->where('get_automobiles.etat','encours')
        ->orderByDesc('created_at')
        ->get();


        return view('pages.demande_automobiles.encour', compact('demande_auto_encours'));
    }

    public function traite()
    {

        $demande_auto_traite = GetAutomobile::select(
            DB::raw('get_automobiles.*'),
            DB::raw("CONCAT(users.nom,' ',users.prenom) as user"),
            DB::raw("CONCAT(type_auto.libelle,' : ',automobiles.caracteristique) as automobile"),

            )
        ->where('get_automobiles.etat','traite')
        ->leftJoin('automobiles','automobiles.id','get_automobiles.automobiles_id')
        ->leftJoin('type_auto','type_auto.id','automobiles.type_auto_id')
        ->leftJoin('users','users.id','get_automobiles.users_id')
        ->orderByDesc('created_at')
        ->get();




        return view('pages.demande_automobiles.traite', compact('demande_auto_traite'));
    }

    public function rejete()
    {

        $demande_auto_rejete = GetAutomobile::select(
            DB::raw('get_automobiles.*'),
            DB::raw("CONCAT(users.nom,' ',users.prenom) as user"),
            DB::raw("CONCAT(type_auto.libelle,' : ',automobiles.caracteristique) as automobile"),

            )
        ->where('get_automobiles.etat','rejete')
        ->leftJoin('automobiles','automobiles.id','get_automobiles.automobiles_id')
        ->leftJoin('type_auto','type_auto.id','automobiles.type_auto_id')
        ->leftJoin('users','users.id','get_automobiles.users_id')
        ->orderByDesc('created_at')
        ->get();



        return view('pages.demande_automobiles.rejete', compact('demande_auto_rejete'));
    }

    public function demande_change_etat($id){
        $demande = GetAutomobile::find($id);
        if($demande){
            $demande->etat = request('etat');
            $demande->users_id = auth()->user()->id;
            if($demande->save()){
                flash()->success('Succès  !', 'Demande Automobile Mise a jour  avec succès');
                return 'ok';
            }
        }

    }
}

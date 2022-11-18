<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use Illuminate\Http\Request;
use App\Models\Itineraire;
use App\Models\Quartier;
use Illuminate\Support\Facades\DB;

class ItineraireController extends Controller
{
    public function index($itineraire_id = null)
    {

        $itineraire = null;

        if ($itineraire_id != null) {
            $itineraire = Itineraire::findOrFail($itineraire_id);
        }
        $itineraires = Itineraire::select(
            DB::raw('itineraires.*'),
            DB::raw("CONCAT(chauffeurs.nom,' ',chauffeurs.prenom) as chauffeur"),
            DB::raw("chauffeurs.telephone as telephone"),
            )
            ->leftJoin('chauffeurs','chauffeurs.id','itineraires.chauffeurs_id')
            ->orderByDesc('itineraires.created_at')
            ->get();

        $itineraires->map(function ($item) {
            $item->depart = Quartier::where('id', '=', $item->quartiers_id)->pluck('libelle')->first();
            $item->arrive = Quartier::where('id', '=', $item->quartiers_id1)->pluck('libelle')->first();

            return $item;
        });
        $chauffeurs = Chauffeur::all();
        $quartiers = Quartier::all();
        return view('pages.itineraires.index', compact('chauffeurs','quartiers','itineraire','itineraires'));
    }

    public function store(Request $request){
        $id = request('itineraire_id');

        if ($id != '') {
            $itineraire = Itineraire::findOrFail($id);

        } else {
            $itineraire = new Itineraire();
        }
        request()->validate([
            'depart' => 'required',
            'arrive' => 'required',
            'prix_min' => 'required',
            'prix_max' => 'required',
            'chauffeur' => 'required',
        ]);

        $itineraire->quartiers_id = request('depart');
        $itineraire->quartiers_id1 = request('arrive');
        $itineraire->prix_min = str_replace(' ', '',  request('prix_min'));
        $itineraire->prix_max = str_replace(' ', '',  request('prix_max'));
        $itineraire->chauffeurs_id = request('chauffeur');

        if($itineraire->save()){
            flash()->success('Succès  !', 'Itineraire enregistré avec succès');
            return redirect()->route('itineraire.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $itineraire = Itineraire::find($id);
            if ($itineraire->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

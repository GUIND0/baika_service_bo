<?php

namespace App\Http\Controllers;

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
            DB::raw('itineraires.*'))
            ->orderByDesc('itineraires.created_at')
            ->get();

        $itineraires->map(function ($item) {
            $item->depart = Quartier::where('id', '=', $item->quartiers_id)->pluck('libelle')->first();
            $item->arrive = Quartier::where('id', '=', $item->quartiers_id1)->pluck('libelle')->first();

            return $item;
        });

        $quartiers = Quartier::all();
        return view('pages.itineraires.index', compact('quartiers','itineraire','itineraires'));
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
            'prix' => 'required',
        ]);

        $itineraire->quartiers_id = request('depart');
        $itineraire->quartiers_id1 = request('arrive');
        $itineraire->prix = str_replace(' ', '',  request('prix'));

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

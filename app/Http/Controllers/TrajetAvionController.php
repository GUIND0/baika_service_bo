<?php

namespace App\Http\Controllers;

use App\Models\TrajetAvion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrajetAvionController extends Controller
{
    public function index($trajet_avion_id = null)
    {

        $trajet_avion = null;

        if ($trajet_avion_id != null) {
            $trajet_avion = TrajetAvion::findOrFail($trajet_avion_id);
        }
        $trajet_avions = TrajetAvion::select(DB::raw('trajet_avions.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.trajet_avions.index', compact('trajet_avion','trajet_avions'));
    }

    public function store(Request $request){
        $id = request('trajet_avion_id');

        if ($id != '') {
            $trajet_avion = TrajetAvion::findOrFail($id);

        } else {
            $trajet_avion = new TrajetAvion();

        }
        request()->validate([
            'depart' => 'required',
            'arrivee' => 'required',
        ]);

        $trajet_avion->depart = request('depart');
        $trajet_avion->arrivee = request('arrivee');

        if($trajet_avion->save()){
            flash()->success('Succès  !', 'Trajet Avion enregistré avec succès');
            return redirect()->route('trajet_avion.index');
        }
        return back();


    }

    public function delete($id){

        if($id){
            $trajet_avion = TrajetAvion::find($id);
            if ($trajet_avion->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

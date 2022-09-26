<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trajet;
use Illuminate\Support\Facades\DB;



class TrajetController extends Controller
{
    public function index($trajet_id = null)
    {

        $trajet = null;

        if ($trajet_id != null) {
            $trajet = Trajet::findOrFail($trajet_id);
        }
        $trajets = Trajet::select(DB::raw('trajets.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.trajets.index', compact('trajet','trajets'));
    }

    public function store(Request $request){
        $id = request('trajet_id');

        if ($id != '') {
            $trajet = Trajet::findOrFail($id);

        } else {
            $trajet = new Trajet();

        }
        request()->validate([
            'libelle' => 'required',
        ]);

        $trajet->libelle = request('libelle');

        if($trajet->save()){
            flash()->success('Succès  !', 'Trajet enregistré avec succès');
            return redirect()->route('trajet.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $trajet = Trajet::find($id);
            if ($trajet->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

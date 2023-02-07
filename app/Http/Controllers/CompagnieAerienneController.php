<?php

namespace App\Http\Controllers;

use App\Models\CompagnieAerienne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompagnieAerienneController extends Controller
{
    public function index($compagnie_aerienne_id = null)
    {

        $compagnie_aerienne = null;

        if ($compagnie_aerienne_id != null) {
            $compagnie_aerienne = CompagnieAerienne::findOrFail($compagnie_aerienne_id);
        }
        $compagnie_aeriennes = CompagnieAerienne::select(DB::raw('compagnie_aeriennes.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.compagnie_aeriennes.index', compact('compagnie_aerienne','compagnie_aeriennes'));
    }

    public function store(Request $request){
        $id = request('compagnie_aerienne_id');

        if ($id != '') {
            $compagnie_aerienne = CompagnieAerienne::findOrFail($id);

        } else {
            $compagnie_aerienne = new CompagnieAerienne();

        }
        request()->validate([
            'libelle' => 'required',
        ]);

        $compagnie_aerienne->libelle = request('libelle');

        if($compagnie_aerienne->save()){
            flash()->success('Succès  !', 'Compagnie_aerienne enregistré avec succès');
            return redirect()->route('compagnie_aerienne.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $compagnie_aerienne = CompagnieAerienne::find($id);
            if ($compagnie_aerienne->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

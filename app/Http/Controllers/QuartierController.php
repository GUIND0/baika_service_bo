<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quartier;
use Illuminate\Support\Facades\DB;
class QuartierController extends Controller
{
    public function index($quartier_id = null)
    {

        $quartier = null;

        if ($quartier_id != null) {
            $quartier = Quartier::findOrFail($quartier_id);
        }
        $quartiers = Quartier::select(DB::raw('quartiers.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.quartiers.index', compact('quartier','quartiers'));
    }

    public function store(Request $request){
        $id = request('quartier_id');

        if ($id != '') {
            $quartier = Quartier::findOrFail($id);

        } else {
            $quartier = new Quartier();

        }
        request()->validate([
            'libelle' => 'required',
        ]);

        $quartier->libelle = request('libelle');

        if($quartier->save()){
            flash()->success('Succès  !', 'Quartier enregistré avec succès');
            return redirect()->route('quartier.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $quartier = Quartier::find($id);
            if ($quartier->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

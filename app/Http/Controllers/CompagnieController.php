<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compagnie;
use Illuminate\Support\Facades\DB;


class CompagnieController extends Controller
{
    public function index($compagnie_id = null)
    {

        $compagnie = null;

        if ($compagnie_id != null) {
            $compagnie = Compagnie::findOrFail($compagnie_id);
        }
        $compagnies = Compagnie::select(DB::raw('compagnies.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.compagnies.index', compact('compagnie','compagnies'));
    }

    public function store(Request $request){
        $id = request('compagnie_id');

        if ($id != '') {
            $compagnie = Compagnie::findOrFail($id);

        } else {
            $compagnie = new Compagnie();

        }
        request()->validate([
            'libelle' => 'required',
        ]);

        $compagnie->libelle = request('libelle');

        if($compagnie->save()){
            flash()->success('Succès  !', 'Compagnie enregistré avec succès');
            return redirect()->route('compagnie.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $compagnie = Compagnie::find($id);
            if ($compagnie->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

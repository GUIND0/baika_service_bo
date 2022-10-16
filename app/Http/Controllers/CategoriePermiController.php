<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriePermi;
use Illuminate\Support\Facades\DB;

class CategoriePermiController extends Controller
{
    public function index($categorie_permi_id = null)
    {

        $categorie_permi = null;

        if ($categorie_permi_id != null) {
            $categorie_permi = CategoriePermi::findOrFail($categorie_permi_id);
        }
        $categorie_permis = CategoriePermi::select(DB::raw('categorie_permis.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.categorie_permis.index', compact('categorie_permi','categorie_permis'));
    }

    public function store(Request $request){

        $id = request('categorie_permi_id');

        if ($id != '') {
            $categorie_permi = CategoriePermi::findOrFail($id);

        } else {
            $categorie_permi = new CategoriePermi();

        }
        request()->validate([
            'libelle' => 'required',
        ]);

        $categorie_permi->libelle = request('libelle');

        if($categorie_permi->save()){
            flash()->success('Succès  !', 'categorie_permi enregistré avec succès');
            return redirect()->route('categorie_permi.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $categorie_permi = CategoriePermi::find($id);
            if ($categorie_permi->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

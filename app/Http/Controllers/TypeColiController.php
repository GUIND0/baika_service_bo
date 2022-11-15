<?php

namespace App\Http\Controllers;

use App\Models\TypeColi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeColiController extends Controller
{
    public function index($type_coli_id = null)
    {

        $type_coli = null;

        if ($type_coli_id != null) {
            $type_coli = TypeColi::findOrFail($type_coli_id);
        }
        $type_colis = TypeColi::select(DB::raw('type_colis.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.type_colis.index', compact('type_coli','type_colis'));
    }

    public function store(Request $request){
        $id = request('type_coli_id');

        if ($id != '') {
            $type_coli = TypeColi::findOrFail($id);

        } else {
            $type_coli = new TypeColi();

        }
        request()->validate([
            'libelle' => 'required',
        ]);

        $type_coli->libelle = request('libelle');

        if($type_coli->save()){
            flash()->success('Succès  !', 'Type auto enregistré avec succès');
            return redirect()->route('type_coli.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $type_coli = TypeColi::find($id);
            if ($type_coli->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

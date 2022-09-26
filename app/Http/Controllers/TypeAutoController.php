<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeAuto;
use Illuminate\Support\Facades\DB;

class TypeAutoController extends Controller
{
    public function index($type_auto_id = null)
    {

        $type_auto = null;

        if ($type_auto_id != null) {
            $type_auto = TypeAuto::findOrFail($type_auto_id);
        }
        $type_autos = TypeAuto::select(DB::raw('type_auto.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.type_autos.index', compact('type_auto','type_autos'));
    }

    public function store(Request $request){
        $id = request('type_auto_id');

        if ($id != '') {
            $type_auto = TypeAuto::findOrFail($id);

        } else {
            $type_auto = new TypeAuto();

        }
        request()->validate([
            'libelle' => 'required',
        ]);

        $type_auto->libelle = request('libelle');

        if($type_auto->save()){
            flash()->success('Succès  !', 'Type auto enregistré avec succès');
            return redirect()->route('type_auto.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $type_auto = TypeAuto::find($id);
            if ($type_auto->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

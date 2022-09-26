<?php

namespace App\Http\Controllers;
use App\Models\Automobile;
use App\Models\TypeAuto;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AutomobileController extends Controller
{
    public function create_or_update($id = null)
    {
        $automobile = null;
        if ($id != null) {
            $automobile = Automobile::findOrFail($id);
        }
        $type_autos = TypeAuto::all();
        $statut = [1,0];

        return view('pages.automobiles.create_or_update', compact('statut','type_autos','automobile'));

    }

    public function index()
    {

        $automobiles = Automobile::select(
            DB::raw("automobiles.*"),
            DB::raw("type_auto.libelle as type_auto")
        )
            ->join('type_auto', 'type_auto.id', 'automobiles.type_auto_id')
            ->get();
        return view('pages.automobiles.index', compact('automobiles'));
    }



    public function store(Request $request)
    {
        $id = request('id');
        if ($id != '') {
            request()->validate([
                'caracteristique' => ['required'],
                'description' => ['required'],
                'type_auto' => ['required'],

            ]);
            $automobile = Automobile::findOrFail($id);
        } else {
            request()->validate([
                'caracteristique' => ['required'],
                'description' => ['required','numeric'],
                'type_auto' => ['required'],
            ]);
            $automobile = new automobile();
        }
        $automobile->caracteristique = request('caracteristique');
        $automobile->description = request('description');
        $automobile->type_auto_id = request('type_auto');
        $automobile->statut = request('statut');
       // $automobile->images_id = request('images');



        if ($automobile->save()) {

            return redirect()->route('automobile.index')
                ->with('success', "Automobile est crée avec succes");
        }

        return back();
    }

    public function delete($id = null)
    {

        $automobile = Automobile::findOrFail($id);
        if ($automobile->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }
}

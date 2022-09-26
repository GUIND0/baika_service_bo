<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeLocation;
use Illuminate\Support\Facades\DB;

class TypeLocationController extends Controller
{
    public function index($type_location_id = null)
    {

        $type_location = null;

        if ($type_location_id != null) {
            $type_location = TypeLocation::findOrFail($type_location_id);
        }
        $type_locations = TypeLocation::select(DB::raw('type_locations.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.type_locations.index', compact('type_location','type_locations'));
    }

    public function store(Request $request){
        $id = request('type_location_id');

        if ($id != '') {
            $type_location = TypeLocation::findOrFail($id);

        } else {
            $type_location = new TypeLocation();

        }
        request()->validate([
            'libelle' => 'required',
        ]);

        $type_location->libelle = request('libelle');

        if($type_location->save()){
            flash()->success('Succès  !', 'Type location enregistré avec succès');
            return redirect()->route('type_location.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $type_location = TypeLocation::find($id);
            if ($type_location->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

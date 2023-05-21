<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualites = Actualite::select(DB::raw('actualites.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.actualites.index', compact('actualites'));
    }

    public function store(Request $request){

        $actualite = new Actualite();


        request()->validate([
            'image' => 'required',
        ]);

        $actualite->image = request('image');

        if ($request->file('image') || $request->file('image') != null) {

            $file = $request->file('image');
            $filename = uniqid() . '.' . $request->file('image')->extension();
            $filePath = public_path() . '/files/images/evenement/';
            $file->move($filePath, $filename);

            $actualite->image =  '/files/images/evenement/' . $filename;
        }


        if($actualite->save()){
            flash()->success('Succès  !', 'Actualite enregistré avec succès');
            return redirect()->route('actualite.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $act = Actualite::find($id);
            if ($act->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

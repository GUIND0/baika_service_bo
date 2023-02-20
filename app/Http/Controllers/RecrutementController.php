<?php

namespace App\Http\Controllers;

use App\Models\CategoriePermi;
use App\Models\Image;
use App\Models\Recrutement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecrutementController extends Controller
{
    public function create_or_update($id = null)
    {
        $recrutement = null;
        $recrutement_image = null;

        if ($id != null) {

            $recrutement = Recrutement::findOrFail($id);
            $recrutement_image = Image::where('recrutements_id',$recrutement->id)->first();
        }
        $statut = [1,0];

        return view('pages.recrutements.create_or_update', compact('recrutement_image','statut','recrutement'));

    }

    public function index()
    {

        $recrutements = Recrutement::select(
            DB::raw("recrutements.*"),

            DB::raw("images.path as image")
            )

            ->leftJoin('images', 'images.recrutements_id', 'recrutements.id')
            ->get();


        return view('pages.recrutements.index', compact('recrutements'));
    }



    public function store(Request $request)
    {
        $id = request('id');
        if ($id != '') {
            request()->validate([
                'nom' => ['required'],
                'prenom' => ['required'],
                'description' => ['required'],
                'image' => ['required'],
                'telephone' => ['required'],

            ]);
            $recrutement = Recrutement::findOrFail($id);
            $image = Image::where('recrutements_id',$recrutement->id)->first();
        } else {
            request()->validate([
                'nom' => ['required'],
                'prenom' => ['required'],
                'description' => ['required'],
                'image' => ['required'],
                'telephone' => ['required'],


            ]);
            $recrutement = new Recrutement();
            $image = new Image();

        }
        $recrutement->nom = request('nom');
        $recrutement->prenom = request('prenom');
        $recrutement->description = request('description');
        $recrutement->statut = request('statut');
        $recrutement->telephone = request('telephone');

        if ($request->file('image') || $request->file('image') != null) {

            $file = $request->file('image');
            $filename = uniqid() . '.' . $request->file('image')->extension();
            $filePath = public_path() . '/files/images/chauffeur/';
            $file->move($filePath, $filename);

            $image->path =  '/files/images/chauffeur/' . $filename;
        }





        if ($recrutement->save()) {

            // photo permis
            $image->recrutements_id =  $recrutement->id;
            $image->save();

            // cv recrutement


            return redirect()->route('recrutement.index')
                ->with('success', "Operation est crée avec succes");
        }

        return back();
    }

    public function delete($id = null)
    {

        $recrutement = Recrutement::findOrFail($id);

        $image = Image::where('recrutements_id',  $recrutement->id)->first();
        $image->forceDelete();

        if ($recrutement->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }
}

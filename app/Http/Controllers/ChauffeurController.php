<?php

namespace App\Http\Controllers;

use App\Models\CategoriePermi;
use App\Models\Chauffeur;
use App\Models\Cv;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChauffeurController extends Controller
{
    public function create_or_update($id = null)
    {
        $chauffeur = null;
        $chauffeur_image = null;
        $cv = null;
        if ($id != null) {

            $chauffeur = Chauffeur::findOrFail($id);
            $cv = Cv::where('chauffeurs_id',$chauffeur->id)->first();
            $chauffeur_image = Image::where('chauffeurs_id',$chauffeur->id)->first();
        }
        $categorie_permis = CategoriePermi::all();
        $statut = [1,0];

        return view('pages.chauffeurs.create_or_update', compact('chauffeur_image','cv','statut','categorie_permis','chauffeur'));

    }

    public function index()
    {

        $chauffeurs = Chauffeur::select(
            DB::raw("chauffeurs.*"),
            DB::raw("categorie_permis.libelle as categorie_permi"),
            DB::raw("cvs.path as cv"),
            DB::raw("images.path as image")
            )
            ->join('categorie_permis', 'categorie_permis.id', 'chauffeurs.categorie_permis_id')
            ->leftJoin('cvs', 'cvs.chauffeurs_id', 'chauffeurs.id')
            ->leftJoin('images', 'images.chauffeurs_id', 'chauffeurs.id')
            ->get();


        return view('pages.chauffeurs.index', compact('chauffeurs'));
    }



    public function store(Request $request)
    {
        $id = request('id');
        if ($id != '') {
            request()->validate([
                'nom' => ['required'],
                'prenom' => ['required'],
                'categorie_permi' => ['required'],
                'image' => ['required'],
                'cv' => ['required'],
                'telephone' => ['required'],

            ]);
            $chauffeur = Chauffeur::findOrFail($id);
            $cv = Cv::where('chauffeurs_id',$chauffeur->id)->first();
            $image = Image::where('chauffeurs_id',$chauffeur->id)->first();
        } else {
            request()->validate([
                'nom' => ['required'],
                'prenom' => ['required'],
                'categorie_permi' => ['required'],
                'image' => ['required'],
                'cv' => ['required'],
                'telephone' => ['required'],


            ]);
            $chauffeur = new chauffeur();
            $image = new Image();
            $cv = new Cv();
        }
        $chauffeur->nom = request('nom');
        $chauffeur->prenom = request('prenom');
        $chauffeur->categorie_permis_id = request('categorie_permi');
        $chauffeur->statut = request('statut');
        $chauffeur->telephone = request('telephone');




        if ($request->file('image') || $request->file('image') != null) {

            $file = $request->file('image');
            $filename = uniqid() . '.' . $request->file('image')->extension();
            $filePath = public_path() . '/files/images/chauffeur/';
            $file->move($filePath, $filename);

            $image->path =  '/files/images/chauffeur/' . $filename;
        }

        if ($request->file('cv') || $request->file('cv') != null) {

            $file = $request->file('cv');
            $filename = uniqid() . '.' . $request->file('cv')->extension();
            $filePath = public_path() . '/files/cvs/chauffeur/';
            $file->move($filePath, $filename);

            $cv->path =  '/files/cvs/chauffeur/' . $filename;
        }



        if ($chauffeur->save()) {

            // photo permis
            $image->chauffeurs_id =  $chauffeur->id;
            $image->save();

            // cv chauffeur
            $cv->chauffeurs_id =  $chauffeur->id;
            $cv->save();

            return redirect()->route('chauffeur.index')
                ->with('success', "Chauffeur est crée avec succes");
        }

        return back();
    }

    public function delete($id = null)
    {

        $chauffeur = Chauffeur::findOrFail($id);

        $cv = Cv::where('chauffeurs_id',  $chauffeur->id)->first();
        $cv->forceDelete();

        $image = Image::where('chauffeurs_id',  $chauffeur->id)->first();
        $image->forceDelete();

        if ($chauffeur->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }
}

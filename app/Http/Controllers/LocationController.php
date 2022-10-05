<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\TypeLocation;
use Illuminate\Support\Facades\DB;
class LocationController extends Controller
{
    public function create_or_update($id = null)
    {
        $location_images =null;

        $location = null;
        if ($id != null) {
            $location = Location::findOrFail($id);
            $location_images = Image::where('locations_id',$location->id)->get();

        }
        $type_locations = TypeLocation::all();
        $carburant =['Essence','Gazoil'];
        $vitesse = ['4','5','6'];
        $etat = ['Neuf','France au revoir','Mauvaise'];
        $modele = ['Toyota','Mercedes','Nissan'];
        $statut = [1,0];
        return view('pages.locations.create_or_update', compact('location_images','statut','modele','type_locations','location', 'carburant','vitesse','etat'));

    }

    public function index()
    {

        $locations = Location::select(
            DB::raw("locations.*"),
            DB::raw("type_locations.libelle as type_location")
        )
            ->join('type_locations', 'type_locations.id', 'locations.type_locations_id')
            ->get();
        return view('pages.locations.index', compact('locations'));
    }



    public function store(Request $request)
    {
        $id = request('id');
        if ($id != '') {
            request()->validate([
                'modele' => ['required'],
                'etat' => ['required'],
                'carburant' => ['required'],
                'couleur_exterieure' => ['required'],
                'type_location' => ['required'],
                'nbre_porte' => ['required'],
                'prix' => ['required'],
                'images' => ['required'],

            ]);
            $location = Location::findOrFail($id);
        } else {
            request()->validate([
                'modele' => ['required'],
                'etat' => ['required'],
                'carburant' => ['required'],
                'couleur_exterieure' => ['required'],
                'type_location' => ['required'],
                'nbre_porte' => ['required'],
                'prix' => ['required'],
                'images' => ['required'],
            ]);
            $location = new location();
        }

        $location->modele = request('modele');
        $location->etat = request('etat');
        $location->version = request('version');
        $location->annee = request('annee');
        $location->modele = request('modele');
        $location->carburant = request('carburant');
        $location->transmission = request('transmission');
        $location->salon = request('salon');
        $location->moteur = request('moteur');
        $location->carrosserie = request('carrosserie');
        $location->vitesse = request('vitesse');
        $location->puissance = request('puissance');
        $location->cylindre = request('cylindre');
        $location->consommation = request('consommation');
        $location->nbre_portes = request('nbre_porte');
        $location->nbre_sieges = request('nbre_siege');
        $location->couleur_exterieure = request('couleur_exterieure');
        $location->couleur_interieure = request('couleur_interieure');
        $location->description = request('description');
        $location->prix = str_replace(' ', '',  request('prix'));
        $location->categorie = request('categorie');
        $location->type_locations_id = request('type_location');
        $location->statut = request('statut');


       $images = request('images');
       $location->save();
       if($images){


        foreach($request->file('images') as $image){

            if ($image || $image != null) {
                $file =$image;
                $filename = uniqid() . '.' . $image->extension();
                $filePath = public_path() . '/files/images/locations/';
                $file->move($filePath, $filename);

                $imageObj = new Image();
                $imageObj->locations_id =  $location->id;
                $imageObj->path =  '/files/images/locations/' . $filename;

                $imageObj->save();

            }
        }
        }
        if ($location->save()) {

            return redirect()->route('location.index')
                ->with('success', "Location est crée avec succes");
        }

        return back();
    }

    public function show($id){
        $location = Location::select(
            DB::raw("locations.*"),
            DB::raw("type_locations.libelle as type_location")
        )
            ->join('type_locations', 'type_locations.id', 'locations.type_locations_id')
            ->where('locations.id',$id)
            ->first();
        $images = Image::where('locations_id',$id)->get();

        return view('pages.locations.show', compact('location','images'));
    }

    public function deleteImage($id)
    {
        //dd('ok');
        $uploadDir  = public_path() . '/files/images/locations/';
        $image = Image::find($id);
       // unlink($uploadDir . $audio->file);
        $image->forcedelete();
        return "done";
    }

    public function delete($id = null)
    {

        $location = Location::findOrFail($id);
        $images = Image::where('locations_id',$location->id)->get();

        foreach( $images as $image){
            $image = Image::find($id);
            // unlink($uploadDir . $audio->file);
             $image->forcedelete();
        }
        if ($location->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }
}

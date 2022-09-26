<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\TypeLocation;
use Illuminate\Support\Facades\DB;
class LocationController extends Controller
{
    public function create_or_update($id = null)
    {
        $location = null;
        if ($id != null) {
            $location = Location::findOrFail($id);
        }
        $type_locations = TypeLocation::all();
        $carburant =['Essence','Gazoil'];
        $vitesse = ['4','5','6'];
        $etat = ['Neuf','France au revoir','Mauvaise'];
        $modele = ['Toyota','Mercedes','Nissan'];
        $statut = [1,0];

        return view('pages.locations.create_or_update', compact('statut','modele','type_locations','location', 'carburant','vitesse','etat'));

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
                'etat' => ['required','numeric'],
                'carburant' => ['required'],
                'vitesse' => ['required'],
                'etat' => ['required'],
                'type_location' => ['required'],
            ]);
            $location = Location::findOrFail($id);
        } else {
            request()->validate([
                'modele' => ['required'],
                'etat' => ['required','numeric'],
                'carburant' => ['required'],
                'vitesse' => ['required'],
                'etat' => ['required'],
                'type_location' => ['required'],
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
        $location->prix = request('prix');
        $location->categorie = request('categorie');
        $location->type_locations_id = request('type_location');
        $location->statut = request('statut');
       // $location->images_id = request('images');



        if ($location->save()) {

            return redirect()->route('location.index')
                ->with('success', "Location est crée avec succes");
        }

        return back();
    }

    public function delete($id = null)
    {

        $location = Location::findOrFail($id);
        if ($location->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }
}

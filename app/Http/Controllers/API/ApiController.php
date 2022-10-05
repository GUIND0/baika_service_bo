<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Automobile;
use App\Models\Image;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function automobiles(Request $request){
        $automobiles = Automobile::select(
            DB::raw("automobiles.*"),
            DB::raw("type_auto.libelle as type_auto"),
            DB::raw("images.path as image")
            )
            ->join('type_auto', 'type_auto.id', 'automobiles.type_auto_id')
            ->leftJoin('images', 'images.automobiles_id', 'automobiles.id')
            ->orderBy('created_at','DESC')
            ->get();

        return $automobiles->toJson();
    }

    public function automobile($id){
        $automobiles = Automobile::select(
            DB::raw("automobiles.*"),
            DB::raw("type_auto.libelle as type_auto"),
            DB::raw("images.path as image")
            )
            ->join('type_auto', 'type_auto.id', 'automobiles.type_auto_id')
            ->join('images', 'images.automobiles_id', 'automobiles.id')
            ->where('automobiles.id',$id)
            ->first();

        return $automobiles->toJson();
    }

    public function locations(){
        $locations = Location::select(
            DB::raw("locations.*"),
            DB::raw("type_locations.libelle as type_location")
        )
            ->join('type_locations', 'type_locations.id', 'locations.type_locations_id')
            ->get();


        return $locations->toJson();
    }


    public function location_images($id){
        $images = Image::where('locations_id',$id)->get();

        return $images->toJson();
    }


    public function location($id){
        $location = Location::select(
            DB::raw("locations.*"),
            DB::raw("type_locations.libelle as type_location")
        )
            ->join('type_locations', 'type_locations.id', 'locations.type_locations_id')
            ->where('locations.id',$id)
            ->first();

            return $location->toJson();
    }
}

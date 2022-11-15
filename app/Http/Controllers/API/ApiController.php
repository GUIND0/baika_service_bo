<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Automobile;
use App\Models\Chauffeur;
use App\Models\Evenement;
use App\Models\Image;
use App\Models\Location;
use App\Models\Quartier;
use App\Models\Ticket;
use App\Models\Tourisme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/automobiles",
     *      operationId="automobiles",
     *      tags={"Api Baika Service"},

     *      summary="Route automobiles",
     *      description="Retourne toutes les automobiles",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Vous n'êtes pas autorisé à consulter cette page."
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="La ressource demandée est introuvable."
     *   ),
     *  )
     */
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

    public function tickets(Request $request){
        $tickets = Ticket::select(
            DB::raw("tickets.*"),
            DB::raw("compagnies.libelle as compagnie"),
            DB::raw("trajets.libelle as trajet")
            )
            ->join('compagnies', 'compagnies.id', 'tickets.compagnies_id')
            ->leftJoin('trajets', 'trajets.id', 'tickets.trajets_id')
            ->orderBy('created_at','DESC')
            ->get();

        return $tickets->toJson();
    }

    public function chauffeurs(Request $request){
        $chauffeurs = Chauffeur::select(
            DB::raw("chauffeurs.*"),
            DB::raw("categorie_permis.libelle as categorie_permi"),
            DB::raw("cvs.path as cv"),
            DB::raw("images.path as image")
            )
            ->join('categorie_permis', 'categorie_permis.id', 'chauffeurs.categorie_permis_id')
            ->leftJoin('cvs', 'cvs.chauffeurs_id', 'chauffeurs.id')
            ->leftJoin('images', 'images.chauffeurs_id', 'chauffeurs.id')
            ->where('chauffeurs.statut',1)
            ->orderBy('created_at','DESC')
            ->get();

        return $chauffeurs->toJson();
    }

    public function evenements(Request $request){
        $evenements = Evenement::select(
            DB::raw("evenements.*"),
            DB::raw("images.path as image"),

            )
            ->join('images', 'images.evenements_id', 'evenements.id')
            ->where('evenements.statut',1)
            ->orderBy('created_at','DESC')
            ->get();

        return $evenements->toJson();
    }

    public function quartiers(Request $request){
        $quartiers = Quartier::select(
            DB::raw("quartiers.id as id"),
            DB::raw("quartiers.libelle as libelle"),
            )
            ->orderBy('created_at','DESC')
            ->get();

        return $quartiers->toJson();
    }

    /**
     * @OA\Get(
     *      path="/api/automobile/{automobile_id}",
     *      operationId="automobile Single",
     *      tags={"Api Baika Service"},

     *      summary="Route automobiles Image",
     *      description="Retourne une automobile",
     *      @OA\Parameter(
     *         description="ID of User",
    *          in="path",
    *          name="automobile_id",
    *          required=true,
    *          example="e1c26f26-7c78-4d06-85c0-132052644648",
    *          @OA\Schema(
    *          type="string",
    *
     *    )
     *           ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Vous n'êtes pas autorisé à consulter cette page."
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="La ressource demandée est introuvable."
     *   ),
     *  )
     */


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






     /**
     * @OA\Get(
     *      path="/api/location/{location_id}/images",
     *      operationId="locationsImage",
     *      tags={"Api Baika Service"},

     *      summary="Route locations Image",
     *      description="Retourne toutes les limages d'une location",
     *      @OA\Parameter(
     *          name="id",
     *          description="Pour la obtenir les images",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *           ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Vous n'êtes pas autorisé à consulter cette page."
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="La ressource demandée est introuvable."
     *   ),
     *  )
     */

    public function location_images($id){
        $images = Image::where('locations_id',$id)->get();

        return $images->toJson();
    }

    public function tourisme_images($id){
        $images = Image::where('tourismes_id',$id)->get();

        return $images->toJson();
    }







     /**
     * @OA\Get(
     *      path="/api/location/{location_id}",
     *      operationId="location Single",
     *      tags={"Api Baika Service"},

     *      summary="Route locations Image",
     *      description="Retourne une location",
     *      @OA\Parameter(
     *         description="ID of User",
    *          in="path",
    *          name="location_id",
    *          required=true,
    *          example="e1c26f26-7c78-4d06-85c0-132052644648",
    *          @OA\Schema(
    *          type="string",
    *
     *    )
     *           ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Vous n'êtes pas autorisé à consulter cette page."
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="La ressource demandée est introuvable."
     *   ),
     *  )
     */


    public function location($id){
        $location = Location::select(
            DB::raw("locations.*"),
            DB::raw("type_locations.libelle as type_location")
        )
            ->join('type_locations', 'type_locations.id', 'locations.type_locations_id')
            ->where('locations.id',$id)
            ->first();
        $images = Image::where('locations_id',$location->id)->get();
        $ArrayImage =[];
        foreach ( $images  as $key =>  $image) {
            array_push($ArrayImage, $image->path);
        }
        $location->images = $ArrayImage;

        return $location->toJson();
    }




    public function tourisme($id){
        $tourisme = Tourisme::select(
            DB::raw("tourismes.*"),
        )
            ->where('tourismes.id',$id)
            ->first();
        $images = Image::where('tourismes_id',$tourisme->id)->get();
        $ArrayImage =[];
        foreach ( $images  as $key =>  $image) {
            array_push($ArrayImage, $image->path);
        }
        $tourisme->images = $ArrayImage;

        return $tourisme->toJson();
    }



/**
     * @OA\Get(
     *      path="/api/locations",
     *      operationId="locations",
     *      tags={"Api Baika Service"},

     *      summary="Route locations",
     *      description="Retourne toutes les locations",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Vous n'êtes pas autorisé à consulter cette page."
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="La ressource demandée est introuvable."
     *   ),
     *  )
     */
    public function locations(){
        $locations = Location::select(
            DB::raw("locations.*"),
            DB::raw("type_locations.libelle as type_location")
        )
            ->join('type_locations', 'type_locations.id', 'locations.type_locations_id')
            ->where('statut',1)
            ->get();

        $locations->map(function ($item) {
            $image = Image::where('locations_id',$item->id)->first();
            $item->image = $image->path;
            return $item;
            });

        return $locations->toJson();
    }

    public function tourismes(){
        $tourismes = tourisme::select(
            DB::raw("tourismes.*"),
        )
        ->where('statut',1)
        ->get();

        $tourismes->map(function ($item) {
            $image = Image::where('tourismes_id',$item->id)->first();
            $item->image = $image->path;
            return $item;
        });


        return $tourismes->toJson();
    }





}

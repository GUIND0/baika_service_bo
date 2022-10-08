<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Automobile;
use App\Models\Image;
use App\Models\Location;
use App\Models\Ticket;
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

            return $location->toJson();
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
            ->get();


        return $locations->toJson();
    }





}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Automobile;
use App\Models\Chauffeur;
use App\Models\DemandeColi;
use App\Models\DemandeTaxi;
use App\Models\Evenement;
use App\Models\GetEvenementTicket;
use App\Models\GetTicket;
use App\Models\Image;
use App\Models\Itineraire;
use App\Models\Location;
use App\Models\Quartier;
use App\Models\Ticket;
use App\Models\Tourisme;
use App\Models\TypeColi;
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

    public function ticket($id){
        $ticket = Ticket::select(
            DB::raw("tickets.*"),
            DB::raw("compagnies.libelle as compagnie"),
            DB::raw("trajets.libelle as trajet")
            )
            ->join('compagnies', 'compagnies.id', 'tickets.compagnies_id')
            ->leftJoin('trajets', 'trajets.id', 'tickets.trajets_id')
            ->where('tickets.id',$id)
            ->first()->makeHidden(['created_at','updated_at']);

        return $ticket->toJson();
    }

    public function create_ticket(Request $request){


        //Variable
        $nom                = $request->nom ;
        $ticket             = $request->ticket ;
        $nbr_ticket         = $request->nbr_ticket ;
        $telephone          = $request->telephone ;



        if($nom == null){ return response(["error"=>"Le nom doit etre renseigné"],400);
        }


        if($nbr_ticket == null){
            return response(["error"=>"Le nombre de ticket doit etre renseigné"],400);
        }
        if($ticket == null){
            return response(["error"=>"L'Id du ticket doit etre renseigné"],400);
        }
        if($telephone == null){
            return response(["error"=>"Le telephone doit etre renseigné"],400);
        }


        $get_ticket  = new GetTicket();

        $get_ticket->nom = $nom;
        $get_ticket->tickets_id = $ticket;
        $get_ticket->telephone = $telephone;

        $ticket = Ticket::find($ticket);
        if($ticket){
            if($ticket->ticket_restant >= $nbr_ticket){
                $get_ticket->nbr_ticket = $nbr_ticket;
                $get_ticket->pu = $ticket->prix;
                $get_ticket->ttc = $ticket->prix * $nbr_ticket ;

                if($get_ticket->save()){
                    $ticket->ticket_restant = $ticket->ticket_restant - $get_ticket->nbr_ticket;
                    if($ticket->save()){
                        return response(["success"=>"Le Ticket est crée avec succes"],200);
                    }

                }else {
                    return response(["error"=>" Le Ticket n'as pas pu etre crée"],400);
                }

            }
            return response(["error"=>" Pas assez de ticket"],400);

        }

        return response(["error"=>" Ticket introuvable"],404);


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
        );
         if(request('libelle') != null ){
                $quartiers =  $quartiers->where('quartiers.libelle', 'like', '%' . request('libelle'). '%');
            }
            $quartiers =  $quartiers->orderBy('created_at','DESC')
            ->get();

        return $quartiers->toJson();
    }

    public function type_colis(Request $request){
        $type_colis = TypeColi::select(
            DB::raw("type_colis.id as id"),
            DB::raw("type_colis.libelle as libelle"),
        )    ->orderBy('created_at','DESC')
            ->get();

        return $type_colis->toJson();
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




    public function evenement($id){
        $evenement = Evenement::select(
            DB::raw("evenements.*"),
            DB::raw("images.path as image")
            )
            ->join('images', 'images.evenements_id', 'evenements.id')
            ->where('evenements.id',$id)
            ->first()->makeHidden(['created_at','updated_at']);

        return $evenement->toJson();
    }

    

    public function location_images($id){
        $images = Image::where('locations_id',$id)->get();

        return $images->toJson();
    }

    public function tourisme_images($id){
        $images = Image::where('tourismes_id',$id)->get();

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

    public function create_demande_colis(Request $request){


        //Variable
        $nom                = $request->nom ;
        $prenom             = $request->prenom ;
        $telephone          = $request->telephone ;
        $depart             = $request->depart ;
        $arrive             = $request->arrive ;
        $type_coli          = $request->type_coli ;
        $poids              = $request->poids ;
        $valeur             = $request->valeur ;

        if($nom == null){
            return response(["error"=>"Le nom doit etre renseigné"],400);
        }
        if($prenom == null){
            return response(["error"=>"Le prénom doit etre renseigné"],400);
        }
        if($telephone == null){
            return response(["error"=>"Le telephone doit etre renseigné"],400);
        }
        if($depart == null){
            return response(["error"=>"Le depart doit etre renseigné"],400);
        }
        if($arrive == null){
            return response(["error"=>"L'arrive doit etre renseigné"],400);
        }
        if($type_coli == null){
            return response(["error"=>"Le type_coli doit etre renseigné"],400);
        }

        $demande  = new DemandeColi();

        $demande->nom = $nom;
        $demande->prenom = $prenom;
        $demande->telephone = $telephone;
        $demande->departs_id = $depart;
        $demande->arrives_id = $arrive;
        $demande->type_colis_id = $type_coli;
        $demande->etat = 'encours';
        $demande->poids = $poids;
        $demande->valeur = $valeur;
        $departVerf = Quartier::find($depart);
        $arriveVerf = Quartier::find($arrive);
        if( $departVerf&& $arriveVerf){
            if( $demande->save()){
                return response(["success"=>" La demande est crée avec succes"],200);
            }else {
                return response(["error"=>" Le dossier n'as pas pu etre crée"],400);
            }
        }else {
            return response(["error"=>" Depart ID ou Arrive ID introuvable "],400);
        }

    }

    public function get_prix($depart_id , $arrive_id){

        $itineraire = Itineraire::select(
            DB::raw('itineraires.*'),
            DB::raw("CONCAT(chauffeurs.nom,' ',chauffeurs.prenom) as chauffeur"),
            DB::raw("chauffeurs.telephone as telephone"),
            )
            ->leftJoin('chauffeurs','chauffeurs.id','itineraires.chauffeurs_id')
            ->where('quartiers_id',$depart_id)->where('quartiers_id1',$arrive_id)->first();

        if($itineraire == null){
            $itineraire = Itineraire::select(
                DB::raw('itineraires.*'),
                DB::raw("CONCAT(chauffeurs.nom,' ',chauffeurs.prenom) as chauffeur"),
                DB::raw("chauffeurs.telephone as telephone"),
                )
                ->leftJoin('chauffeurs','chauffeurs.id','itineraires.chauffeurs_id')
                ->where('quartiers_id1',$depart_id)->where('quartiers_id',$arrive_id)->first();


            if($itineraire == null){
                return 0;
            }
        }

        return $itineraire->toJson();
    }

    public function create_demande_taxi(Request $request){


        //Variable
        $nom                = $request->nom ;
        $prix               = $request->prix ;
        $depart             = $request->depart ;
        $arrive             = $request->arrive ;
        $telephone          = $request->telephone ;



        if($nom == null){
            return response(["error"=>"Le nom doit etre renseigné"],400);
        }
        if($prix == null){
            return response(["error"=>"Le prix doit etre renseigné"],400);
        }

        if($depart == null){
            return response(["error"=>"Le depart doit etre renseigné"],400);
        }
        if($arrive == null){
            return response(["error"=>"L'arrive doit etre renseigné"],400);
        }
        if($telephone == null){
            return response(["error"=>"Le telephone doit etre renseigné"],400);
        }


        $demande  = new DemandeTaxi();

        $demande->nom = $nom;
        $demande->prix = $prix;
        $demande->departs_id = $depart;
        $demande->arrives_id = $arrive;
        $demande->telephone = $telephone;
        $demande->etat = 'encours';

        $departVerf = Quartier::find($depart);
        $arriveVerf = Quartier::find($arrive);
        if( $departVerf&& $arriveVerf){
            if( $demande->save()){
                return response(["success"=>" La demande est crée avec succes"],200);
            }else {
                return response(["error"=>" Le dossier n'as pas pu etre crée"],400);
            }
        }else {
            return response(["error"=>" Depart ID ou Arrive ID introuvable "],400);
        }

    }




    public function create_evenement_ticket(Request $request){


        //Variable
        $nom                = $request->nom ;
        $evenement          = $request->evenement ;
        $nbr_ticket         = $request->nbr_ticket ;
        $telephone          = $request->telephone ;



        if($nom == null){
            return response(["error"=>"Le nom doit etre renseigné"],400);
        }

        if($nbr_ticket == null){
            return response(["error"=>"Le nombre de ticket doit etre renseigné"],400);
        }
        if($evenement == null){
            return response(["error"=>"L'Id du evenement doit etre renseigné"],400);
        }
        if($telephone == null){
            return response(["error"=>"Le telephone doit etre renseigné"],400);
        }


        $get_evenement  = new GetEvenementTicket();

        $get_evenement->nom = $nom;
        $get_evenement->evenements_id = $evenement;
        $get_evenement->telephone = $telephone;

        $evenement = Evenement::find($evenement);

        if($evenement){
            if($evenement->ticket_restant >= $nbr_ticket){
                $get_evenement->nbr_ticket = $nbr_ticket;
                $get_evenement->pu = $evenement->prix;
                $get_evenement->ttc = $evenement->prix * $nbr_ticket ;

                if($get_evenement->save()){
                    $evenement->ticket_restant = $evenement->ticket_restant - $get_evenement->nbr_ticket;
                    if($evenement->save()){
                        return response(["success"=>"Le Ticket Evenement est crée avec succes"],200);
                    }

                }else {
                    return response(["error"=>" Le Ticket Evenement n'as pas pu etre crée"],400);
                }

            }
            return response(["error"=>" Pas assez de ticket"],400);

        }


        return response(["error"=>" Evenement introuvable"],404);


    }

}

<?php

namespace App\Http\Controllers\API;

use App\Models\Image;
use App\Models\Notif;
use App\Models\Retour;
use App\Models\Ticket;
use App\Models\Location;
use App\Models\Quartier;
use App\Models\Tourisme;
use App\Models\TypeColi;
use App\Models\Evenement;
use App\Models\GetBillet;
use App\Models\GetTicket;
use App\Models\Annulation;
use App\Models\Automobile;
use App\Models\Itineraire;
use App\Models\BilletAvion;
use App\Models\DemandeColi;
use App\Models\DemandeTaxi;
use App\Models\Recrutement;
use Illuminate\Http\Request;
use App\Models\GetAutomobile;
use App\Models\GetRecrutement;
use App\Models\GetEvenementTicket;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class ApiController extends Controller
{

    public function om_return(Request $request){
        $cles = implode(",",$request->all()->keys());
        $valeurs = implode(",",$request->all());
        $retour = new Retour();
        $retour->cles = $cles;
        $retour->valeurs = $valeurs;
        $retour->save();
        return response()->json($retour,200);
    }

    public function om_cancel(Request $request){
        $string = implode(",",$request);
        $retour = new Annulation();
        $retour->contenu = $string;
        $retour->save();
    }


    public function om_notif(Request $request){
        $string = implode(",",$request);
        $retour = new Notif();
        $retour->contenu = $string;
        $retour->save();
    }

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
        $page = 0 ;
        if(request()->isMethod('get')){
            if(request('page') && request('page') != ""){
                $page = request('page');
            }
        };
        $tickets = Ticket::select(
            DB::raw("tickets.*"),
            DB::raw("compagnies.libelle as compagnie"),
            DB::raw("trajets.depart as depart"),
            DB::raw("trajets.arrivee as arrivee"),
            )
            ->join('compagnies', 'compagnies.id', 'tickets.compagnies_id')
            ->leftJoin('trajets', 'trajets.id', 'tickets.trajets_id')
            ->where('tickets.ticket_restant', '>', 0)
            ->orderBy('created_at','DESC')
            ->offset($page * 5)
            ->limit(5)
            ->get();

        return $tickets->toJson();
    }

    public function ticket($id){

        $ticket = Ticket::select(
            DB::raw("tickets.*"),
            DB::raw("compagnies.libelle as compagnie"),
            DB::raw("trajets.depart as depart"),
            DB::raw("trajets.arrivee as arrivee"),
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

    public function billets(Request $request){
        $page = 0 ;
        if(request()->isMethod('get')){
            if(request('page') && request('page') != ""){
                $page = request('page');
            }
        };
        $billets = BilletAvion::select(
            DB::raw("billet_avions.*"),
            DB::raw("compagnie_aeriennes.libelle as compagnie"),
            DB::raw("trajet_avions.depart as depart"),
            DB::raw("trajet_avions.arrivee as arrivee")
            )
            ->join('compagnie_aeriennes', 'compagnie_aeriennes.id', 'billet_avions.compagnie_aeriennes_id')
            ->leftJoin('trajet_avions', 'trajet_avions.id', 'billet_avions.trajet_avions_id')
            ->where('billet_avions.billet_restant', '>', 0)
            ->orderBy('created_at','DESC')
            ->offset($page * 5)
            ->limit(5)
            ->get();

        return $billets->toJson();
    }

    public function billet($id){
        $billet = BilletAvion::select(
            DB::raw("billet_avions.*"),
            DB::raw("compagnie_aeriennes.libelle as compagnie"),
            DB::raw("trajet_avions.depart as depart"),
            DB::raw("trajet_avions.arrivee as arrivee")
            )
            ->join('compagnie_aeriennes', 'compagnie_aeriennes.id', 'billet_avions.compagnie_aeriennes_id')
            ->leftJoin('trajet_avions', 'trajet_avions.id', 'billet_avions.trajet_avions_id')
            ->where('billet_avions.id',$id)
            ->first()->makeHidden(['created_at','updated_at']);

        return $billet->toJson();
    }

    public function create_billet(Request $request){


        //Variable
        $nom                = $request->nom ;
        $billet             = $request->billet ;
        $nbr_billet         = $request->nbr_billet ;
        $telephone          = $request->telephone ;



        if($nom == null){ return response(["error"=>"Le nom doit etre renseigné"],400);
        }


        if($nbr_billet == null){
            return response(["error"=>"Le nombre de billet doit etre renseigné"],400);
        }
        if($billet == null){
            return response(["error"=>"L'Id du billet doit etre renseigné"],400);
        }
        if($telephone == null){
            return response(["error"=>"Le telephone doit etre renseigné"],400);
        }


        $get_billet  = new GetBillet();

        $get_billet->nom = $nom;
        $get_billet->billet_avions_id = $billet;
        $get_billet->telephone = $telephone;

        $billet = BilletAvion::find($billet);
        if($billet){
            if($billet->billet_restant >= $nbr_billet){
                $get_billet->nbr_billet = $nbr_billet;
                $get_billet->pu = $billet->prix;
                $get_billet->ttc = $billet->prix * $nbr_billet ;

                if($get_billet->save()){
                    $billet->billet_restant = $billet->billet_restant - $get_billet->nbr_billet;
                    if($billet->save()){
                        return response(["success"=>"Le billet est crée avec succes"],200);
                    }

                }else {
                    return response(["error"=>" Le billet n'as pas pu etre crée"],400);
                }

            }
            return response(["error"=>" Pas assez de billet"],400);

        }

        return response(["error"=>" billet introuvable"],404);
    }

    public function recrutements(Request $request){
        $page = 0 ;
        if(request()->isMethod('get')){
            if(request('page') && request('page') != ""){
                $page = request('page');
            }
        };

        $recrutements = Recrutement::select(
            DB::raw("recrutements.*"),
            DB::raw("images.path as image")
            )

            ->leftJoin('images', 'images.recrutements_id', 'recrutements.id')
            ->where('recrutements.statut',1)
            ->orderBy('created_at','DESC')
            ->offset($page * 5)
            ->limit(5)
            ->get();

        return $recrutements->toJson();
    }

    public function evenements(Request $request){
        $page = 0 ;
        if(request()->isMethod('get')){
            if(request('page') && request('page') != ""){
                $page = request('page');
            }
        };

        $evenements = Evenement::select(
            DB::raw("evenements.*"),
            DB::raw("images.path as image"),

            )
            ->join('images', 'images.evenements_id', 'evenements.id')
            ->where('evenements.statut',1)
            ->orderBy('created_at','DESC')
            ->offset($page * 5)
            ->limit(5)
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

    public function create_automobile(Request $request){
        $nom                = $request->nom ;
        $automobile             = $request->automobile ;
        $telephone          = $request->telephone ;

        if($nom == null){
            return response(["error"=>"Le nom doit etre renseigné"],400);
        }
        if($automobile == null){
            return response(["error"=>"Le prénom doit etre renseigné"],400);
        }
        if($telephone == null){
            return response(["error"=>"Le telephone doit etre renseigné"],400);
        }

        $automobileVerif = Automobile::find($automobile);
        if(!$automobileVerif){
            return response(["error"=>" Automobile Introuvable"],404);
        }
        $get_automobile  = new GetAutomobile();

        $get_automobile->nom = $nom;

        $get_automobile->automobiles_id = $automobile;
        $get_automobile->telephone = $telephone;
        $get_automobile->etat = 'encours';

        if( $get_automobile->save()){
            return response(["success"=>" La demande automobile est crée avec succes"],200);
        }else {
            return response(["error"=>" La demande n'as pas pu etre crée"],400);
        }

    }

    public function create_recrutement(Request $request){
        $nom                = $request->nom ;
        $recrutement        = $request->recrutement ;
        $telephone          = $request->telephone ;

        if($nom == null){
            return response(["error"=>"Le nom doit etre renseigné"],400);
        }
        if($recrutement == null){
            return response(["error"=>"Id doit etre renseigné"],400);
        }
        if($telephone == null){
            return response(["error"=>"Le telephone doit etre renseigné"],400);
        }

        $recrutementVerif = Recrutement::find($recrutement);
        if(!$recrutementVerif){
            return response(["error"=>" recrutement Introuvable"],404);
        }
        $get_recrutement  = new GetRecrutement();

        $get_recrutement->nom = $nom;
        $get_recrutement->recrutements_id = $recrutement;
        $get_recrutement->telephone = $telephone;
        $get_recrutement->etat = 'encours';

        if( $get_recrutement->save()){
            return response(["success"=>" Recrutement est crée avec succes"],200);
        }else {
            return response(["error"=>" Recrutement n'as pas pu etre crée"],400);
        }

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
            DB::raw("CONCAT(recrutements.nom,' ',recrutements.prenom) as chauffeur"),
            DB::raw("recrutements.telephone as telephone"),
            )
            ->leftJoin('recrutements','recrutements.id','itineraires.recrutements_id')
            ->where('quartiers_id',$depart_id)->where('quartiers_id1',$arrive_id)->first();

        if($itineraire == null){
            $itineraire = Itineraire::select(
                DB::raw('itineraires.*'),
                DB::raw("CONCAT(recrutements.nom,' ',recrutements.prenom) as chauffeur"),
                DB::raw("recrutements.telephone as telephone"),
                )
                ->leftJoin('recrutements','recrutements.id','itineraires.recrutements_id')
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Trajet;
use App\Models\Compagnie;
use App\Models\GetTicket;
use Illuminate\Support\Facades\DB;



class TicketController extends Controller
{
    public function create_or_update($id = null)
    {
        $ticket = null;
        if ($id != null) {
            $ticket = Ticket::findOrFail($id);
        }
        $compagnies = Compagnie::all();
        $trajets = Trajet::all();


        return view('pages.tickets.create_or_update', compact('ticket',  'compagnies', 'trajets'));

    }

    public function index()
    {

        $tickets = Ticket::select(
            DB::raw("tickets.*"),
            DB::raw("trajets.libelle as trajet"),
            DB::raw("compagnies.libelle as compagnie")
        )
            ->join('compagnies', 'compagnies.id', 'tickets.compagnies_id')
            ->join('trajets', 'trajets.id', 'tickets.trajets_id')
            ->get();
        return view('pages.tickets.index', compact('tickets'));
    }



    public function store(Request $request)
    {
        $id = request('id');
        if ($id != '') {
            request()->validate([
                'ticket_restant' => ['required'],
                'prix' => ['required'],
                'date_depart' => ['required'],
                'heure_depart' => ['required'],
                'trajet' => ['required'],
                'compagnie' => ['required'],
            ]);
            $ticket = Ticket::findOrFail($id);
        } else {
            request()->validate([
                'ticket_restant' => ['required'],
                'prix' => ['required'],
                'date_depart' => ['required'],
                'heure_depart' => ['required'],
                'trajet' => ['required'],
                'compagnie' => ['required'],

            ]);
            $ticket = new Ticket();
        }
        $ticket->ticket_restant = request('ticket_restant');
        $ticket->prix =str_replace(' ', '',  request('prix'));
        $ticket->date_depart = request('date_depart');
        $ticket->heure_depart = request('heure_depart');
        $ticket->compagnies_id = request('compagnie');
        $ticket->trajets_id = request('trajet');



        if ($ticket->save()) {

            return redirect()->route('ticket.index')
                ->with('success', "Le ticket est crée avec succes");
        }

        return back();
    }

    public function delete($id = null)
    {

        $ticket = Ticket::findOrFail($id);
        if ($ticket->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }

    public function show($id)
    {

        $ticket = Ticket::select(
            DB::raw("tickets.*"),
            DB::raw("trajets.libelle as trajet"),
            DB::raw("compagnies.libelle as compagnie")
        )
            ->join('compagnies', 'compagnies.id', 'tickets.compagnies_id')
            ->join('trajets', 'trajets.id', 'tickets.trajets_id')
            ->where('tickets.id',$id)
            ->first();

        $get_tickets = GetTicket::select(
            DB::raw("get_tickets.*"),

        )
            ->where('get_tickets.tickets_id',$id)
            ->get();


        return view('pages.tickets.show', compact('get_tickets','ticket'));


    }

}

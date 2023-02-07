<?php

namespace App\Http\Controllers;

use App\Models\BilletAvion;
use App\Models\CompagnieAerienne;
use App\Models\GetBillet;
use App\Models\TrajetAvion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BilletAvionController extends Controller
{
    public function create_or_update($id = null)
    {
        $billet = null;
        if ($id != null) {
            $billet = BilletAvion::findOrFail($id);
        }
        $compagnies = CompagnieAerienne::all();
        $trajets = TrajetAvion::all();


        return view('pages.billets.create_or_update', compact('billet',  'compagnies', 'trajets'));

    }

    public function index()
    {

        $billets = BilletAvion::select(
            DB::raw("billet_avions.*"),
            DB::raw("trajet_avions.libelle as trajet"),
            DB::raw("compagnie_aeriennes.libelle as compagnie")
        )
            ->join('compagnie_aeriennes', 'compagnie_aeriennes.id', 'billet_avions.compagnie_aeriennes_id')
            ->join('trajet_avions', 'trajet_avions.id', 'billet_avions.trajet_avions_id')
            ->get();

        return view('pages.billets.index', compact('billets'));
    }



    public function store(Request $request)
    {
        $id = request('id');
        if ($id != '') {
            request()->validate([
                'ticket_restant' => ['required'],
                'prix' => ['required'],
                'ref_billet' => ['required'],
                'date_depart' => ['required'],
                'heure_depart' => ['required'],
                'trajet' => ['required'],
                'compagnie' => ['required'],
            ]);
            $billet = BilletAvion::findOrFail($id);
        } else {
            request()->validate([
                'billet_restant' => ['required'],
                'prix' => ['required'],
                'ref_billet' => ['required'],
                'date_depart' => ['required'],
                'heure_depart' => ['required'],
                'trajet' => ['required'],
                'compagnie' => ['required'],

            ]);
            $billet = new BilletAvion();
        }
        $billet->billet_restant = request('billet_restant');
        $billet->prix =str_replace(' ', '',  request('prix'));
        $billet->date_depart = request('date_depart');
        $billet->ref_billet = request('ref_billet');
        $billet->heure_depart = request('heure_depart');
        $billet->compagnie_aeriennes_id = request('compagnie');
        $billet->trajet_avions_id = request('trajet');



        if ($billet->save()) {

            return redirect()->route('billet.index')
                ->with('success', "Le billet est crée avec succes");
        }

        return back();
    }

    public function delete($id = null)
    {

        $billet = BilletAvion::findOrFail($id);
        if ($billet->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }

    public function show($id)
    {

        $billet = BilletAvion::select(
            DB::raw("billet_avions.*"),
            DB::raw("trajet_avions.libelle as trajet"),
            DB::raw("compagnie_aeriennes.libelle as compagnie")
        )
            ->join('compagnie_aeriennes', 'compagnie_aeriennes.id', 'billet_avions.compagnie_aeriennes_id')
            ->join('trajet_avions', 'trajet_avions.id', 'billet_avions.trajet_avions_id')
            ->where('billet_avions.id',$id)
            ->first();

        $get_billets = GetBillet::select(
            DB::raw("get_billets.*"),

        )
            ->where('get_billets.billet_avions_id',$id)
            ->get();


        return view('pages.billets.show', compact('get_billets','billet'));


    }
}

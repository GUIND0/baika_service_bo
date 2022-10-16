<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvenementController extends Controller
{
    public function create_or_update($id = null)
    {

        $evenement = null;
        $evenement_image = null;
        if ($id != null) {

            $evenement = Evenement::findOrFail($id);
            $evenement_image = Image::where('evenements_id',$evenement->id)->first();
        }

        $statut = [1,0];


        return view('pages.evenements.create_or_update', compact('evenement','evenement_image','statut'));

    }

    public function index()
    {

        $evenements = Evenement::select(
            DB::raw("evenements.*"),
            DB::raw("images.path as image"),
        )
            ->join('images', 'images.evenements_id', 'evenements.id')
            ->get();
        return view('pages.evenements.index', compact('evenements'));
    }



    public function store(Request $request)
    {
        $id = request('id');
        if ($id != '') {
            request()->validate([
                'ticket_restant' => ['required'],
                'prix' => ['required'],
                'date' => ['required'],
                'heure' => ['required'],
                'description' => ['required'],
                'image' => ['required'],
                'statut' => ['required'],
                'lieu' => ['required'],
            ]);
            $evenement = Evenement::findOrFail($id);
            $image = Image::where('evenements_id',$evenement->id)->first();

        } else {
            request()->validate([
                'ticket_restant' => ['required'],
                'prix' => ['required'],
                'date' => ['required'],
                'heure' => ['required'],
                'description' => ['required'],
                'image' => ['required'],
                'statut' => ['required'],
                'lieu' => ['required'],
            ]);
            $evenement = new evenement();
            $image = new Image();

        }
        $evenement->ticket_restant = request('ticket_restant');
        $evenement->prix =str_replace(' ', '',  request('prix'));
        $evenement->date = request('date');
        $evenement->heure = request('heure');
        $evenement->description = request('description');
        $evenement->lieu = request('lieu');
        $evenement->statut = request('statut');

        if ($request->file('image') || $request->file('image') != null) {

            $file = $request->file('image');
            $filename = uniqid() . '.' . $request->file('image')->extension();
            $filePath = public_path() . '/files/images/evenement/';
            $file->move($filePath, $filename);

            $image->path =  '/files/images/evenement/' . $filename;
        }

        if ($evenement->save()) {

            $image->evenements_id =  $evenement->id;
            $image->save();

            return redirect()->route('evenement.index')
                ->with('success', "L'evenement est crée avec succes");
        }

        return back();
    }

    public function delete($id = null)
    {

        $evenement = Evenement::findOrFail($id);
        $image = Image::where('evenements_id',  $evenement->id)->first();
        $image->forceDelete();
        if ($evenement->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }
}

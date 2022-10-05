<?php

namespace App\Http\Controllers;
use App\Models\Automobile;
use App\Models\Image;
use App\Models\TypeAuto;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AutomobileController extends Controller
{
    public function create_or_update($id = null)
    {
        $automobile = null;
        $automobile_image = null;
        if ($id != null) {

            $automobile = Automobile::findOrFail($id);
            $automobile_image = Image::where('automobiles_id',$automobile->id)->first();
        }
        $type_autos = TypeAuto::all();
        $statut = [1,0];

        return view('pages.automobiles.create_or_update', compact('automobile_image','statut','type_autos','automobile'));

    }

    public function index()
    {

        $automobiles = Automobile::select(
            DB::raw("automobiles.*"),
            DB::raw("type_auto.libelle as type_auto"),
            DB::raw("images.path as image")
            )
            ->join('type_auto', 'type_auto.id', 'automobiles.type_auto_id')
            ->leftJoin('images', 'images.automobiles_id', 'automobiles.id')
            ->get();


        return view('pages.automobiles.index', compact('automobiles'));
    }



    public function store(Request $request)
    {
        $id = request('id');
        if ($id != '') {
            request()->validate([
                'caracteristique' => ['required'],
                'description' => ['required'],
                'type_auto' => ['required'],
                'statut' => ['required'],

            ]);
            $automobile = Automobile::findOrFail($id);
            $imageObj = Image::where('automobiles_id',$automobile->id)->first();
        } else {
            request()->validate([
                'caracteristique' => ['required'],
                'description' => ['required'],
                'type_auto' => ['required'],
                'statut' => ['required'],
                'image' => ['required'],

            ]);
            $automobile = new automobile();
            $imageObj = new Image();
        }
        $automobile->caracteristique = request('caracteristique');
        $automobile->description = request('description');
        $automobile->type_auto_id = request('type_auto');
        $automobile->statut = request('statut');




        if ($request->file('image') || $request->file('image') != null) {

            $file = $request->file('image');
            $filename = uniqid() . '.' . $request->file('image')->extension();
            $filePath = public_path() . '/files/images/automobile/';
            $file->move($filePath, $filename);

            $imageObj->path =  '/files/images/automobile/' . $filename;
        }



        if ($automobile->save()) {


            $imageObj->automobiles_id =  $automobile->id;


            $imageObj->save();

            return redirect()->route('automobile.index')
                ->with('success', "Automobile est crée avec succes");
        }

        return back();
    }

    public function delete($id = null)
    {

        $automobile = Automobile::findOrFail($id);
        $image = Image::where('automobiles_id',  $automobile->id)->first();
        $image->forceDelete();
        if ($automobile->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tourisme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourismeController extends Controller
{
    public function create_or_update($id = null)
    {
        $tourisme_images =null;
        $tourisme = null;
        if ($id != null) {
            $tourisme = Tourisme::findOrFail($id);
            $tourisme_images = Image::where('tourismes_id',$tourisme->id)->get();

        }

        $statut = [1,0];
        return view('pages.tourismes.create_or_update', compact('tourisme_images','statut','tourisme'));

    }

    public function index()
    {

        $tourismes = Tourisme::select(
            DB::raw("tourismes.*"),
        )
            ->get();
        return view('pages.tourismes.index', compact('tourismes'));
    }



    public function store(Request $request)
    {

        $id = request('id');
        if ($id != '') {

            request()->validate([
                'nom' => ['required'],
                'lieu' => ['required'],
                'description' => ['required'],

            ]);
            $tourisme = Tourisme::findOrFail($id);
        } else {
            request()->validate([
                'nom' => ['required'],
                'lieu' => ['required'],
                'description' => ['required'],
                'images' => ['required'],
            ]);
            $tourisme = new Tourisme();
        }

        $tourisme->nom = request('nom');
        $tourisme->lieu = request('lieu');
        $tourisme->description = request('description');
        $tourisme->statut = request('statut');


       $images = request('images');
       $tourisme->save();
       if($images){

        foreach($request->file('images') as $image){

            if ($image || $image != null) {
                $file =$image;
                $filename = uniqid() . '.' . $image->extension();
                $filePath = public_path() . '/files/images/tourismes/';
                $file->move($filePath, $filename);

                $imageObj = new Image();
                $imageObj->tourismes_id =  $tourisme->id;
                $imageObj->path =  '/files/images/tourismes/' . $filename;

                $imageObj->save();

            }
        }
        }
        if ($tourisme->save()) {

            return redirect()->route('tourisme.index')
                ->with('success', "Tourisme est crée avec succes");
        }

        return back();
    }

    public function show($id){
        $tourisme = Tourisme::select(
            DB::raw("tourismes.*"),
        )
            ->where('tourismes.id',$id)
            ->first();
        $images = Image::where('tourismes_id',$id)->get();

        return view('pages.tourismes.show', compact('tourisme','images'));
    }

    public function deleteImage($id)
    {
        //dd('ok');
        $uploadDir  = public_path() . '/files/images/tourismes/';
        $image = Image::find($id);
       // unlink($uploadDir . $audio->file);
        $image->forcedelete();
        return "done";
    }

    public function delete($id = null)
    {

        $tourisme = Tourisme::findOrFail($id);
        $images = Image::where('tourismes_id',$tourisme->id)->get();

        foreach( $images as $image){
            $image = Image::find($id);
            // unlink($uploadDir . $audio->file);
             $image->forcedelete();
        }
        if ($tourisme->forceDelete()) {
            return "done";
        } else {
            return "fail";
        }
    }
}

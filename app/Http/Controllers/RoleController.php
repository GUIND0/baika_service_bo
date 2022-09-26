<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{
    public function index($role_id = null)
    {

        $role = null;

        if ($role_id != null) {
            $role = Role::findOrFail($role_id);
        }
        $roles = Role::select(DB::raw('roles.*'),)
        ->orderByDesc('created_at')
            ->get();

        return view('pages.roles.index', compact('role','roles'));
    }

    public function store(Request $request){
        $id = request('role_id');

        if ($id != '') {
            $role = Role::findOrFail($id);

        } else {
            $role = new Role();

        }
        request()->validate([
            'libelle' => 'required',
        ]);

        $role->libelle = request('libelle');

        if($role->save()){
            flash()->success('Succès  !', 'Role enregistré avec succès');
            return redirect()->route('role.index');
        }
        return back();


    }

    public function delete($id){
        if($id){
            $role = Role::find($id);
            if ($role->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }
}

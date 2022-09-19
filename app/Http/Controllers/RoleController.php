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
            'description' => 'required',
        ]);

        $role->libelle = request('libelle');
        $role->description = request('description');

        if($role->save()){
            flash()->success('Succès !', 'Role enregistré avec succès');
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

    public function permission($role_id){

//        dd(auth()->user()->isAuthorized('User','login'));

        $role = Role::find($role_id);

        if ($role){

            $controllers = [];
            $data = [];
            $selected = [];
            //pour chaque route
            foreach (Route::getRoutes()->getRoutes() as $route)
            {
                //on recupere les differentes actions liés a laravel
                $action = $route->getAction();

                if (array_key_exists('controller', $action))
                {
                    //on sépare nom du controller de la methode,  controllers[0] => controller_name,  controllers[1] => controller_method
                    $controllers[] = explode('@', $action['controller']);

                    foreach($controllers as $key => $val) {
                        $controllers[$key] = str_replace("App\Http\Controllers\\",'',$controllers[$key]);
                        $controllers[$key] = str_replace("Controllers",'',$controllers[$key]);
                        $controllers[$key] = str_replace("Controller",'',$controllers[$key]);

                        if(str_contains('Api\Api',$controllers[$key][0]) || str_contains('Laravel\Sanctum\\Http\\\CsrfCookie',$controllers[$key][0])){
//                            unset($controllers[$key]);
//                            dd($controllers[$key][0]);
                        }else{

                            $nom = (String)$key;

                        //si la clé n'existe pas dans data
                        if(  ! array_key_exists($key,$data)){

                            //si une methode existe sur ce controlleur
                            if( array_key_exists(1,$controllers[$key])){

                                //si la clé existe deja dans data
                                if ( array_key_exists($controllers[$nom][0],$data )){

                                    //on ajoute une valeur dans data correspondant a la methode du controlleur
                                    if( ! in_array($controllers[$key][1],$data[$controllers[$key][0]]['actions'])){

                                        $data[$controllers[$key][0]]['actions'][] = $controllers[$key][1];

                                        $contro = $controllers[$key][0];

                                        $action = $controllers[$key][1];

                                        $perm = Permission::Where('roles_id',$role_id)->where('controller',$contro)->Where('action',$action)->get();

                                        if(count($perm) > 0){
                                            array_push($selected,$contro.".".$action);
                                        };
                                    }

                                //Sinon on crée la clé
                                }else{
                                    $contro = $controllers[$key][0];

                                    $action = $controllers[$key][1];

                                    $data[$controllers[$key][0]]['actions'][] = $controllers[$key][1];

                                    $perm = Permission::Where('roles_id',$role_id)->where('controller',$contro)->Where('action',$action)->get();

                                    if(count($perm) > 0){
                                        array_push($selected,$contro.".".$action);
                                    };

                                }
                            }
                        }
                        }

                    }

                }
            }
//            dd($data,$selected);
//            dd($selected);
            return view('pages.roles.permission', compact('role','data','selected'));
        }
        flash()->error('Erreur !', 'Role introuvable');
        return back();
    }

    public function permission_store(Request $request){
        request()->validate([
            'controllers' => 'required',
            'role_id' => 'required',
        ]);
        $role = Role::find($request->role_id);

        $controllers = $request->controllers;
        $role->permissions()->delete();
//        dd($request);
        foreach ($controllers as $row){
            $f = explode('.',$row);
            $contro = $f[0];
            $action = $f[1];
            $perm = new Permission();
            $perm->roles_id         = $role->id;
            $perm->controller       = $contro ;
            $perm->action           = $action ;
            $perm->save();
        }
        flash()->success('Success!', 'Permissions enregistrées');
        return back();
    }
    public function pagination(Request $request)
    {

                $offset     =   $request->offset ;
                $limit      =   $request->limit ;
                $order_val  =   $request->order;
                $sort       =   $request->sort;
                $search     =   $request->search;

                if($sort){

                    $test =  DB::table('roles')
                                ->skip($offset)
                                ->take($limit)
                                ->orderBy($sort,$order_val)
                                ->get();
                }elseif($search){

                     $test =  DB::table('roles')
                                 ->where('libelle','LIKE',"%{$search}%")
                                 ->skip($offset)
                                 ->take($limit)
                                 ->orderBy("libelle",$order_val)
                                 ->get();
                 }
                else{

                    $test =  DB::table('roles')
                                ->skip($offset)
                                ->take($limit)
                                ->orderBy("created_at",$order_val)
                                ->get();
                }
                $data = [ "total"=> Role::where('libelle','LIKE',"%{$search}%")
                                                ->count(),
                        "totalNotFiltered"=> Role::all()->count(),
                        //"totalFilteredRecord"=> Localite::where('nom','LIKE',"$search")->count(),
                        "rows"=> $test];

                return $data;
    }
}

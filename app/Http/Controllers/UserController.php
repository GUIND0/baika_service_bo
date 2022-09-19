<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Localite;
use App\Models\UsersPasswordManagement;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {
        if (auth()->guest()) {
            return redirect('/login');
        }

       $users = User::select(
           DB::raw('users.*'),
           DB::raw('roles.libelle as role'),
           DB::raw('localites.nom as localite'),
           )
        ->leftJoin('roles','users.roles_id','roles.id')
        ->leftJoin('localites','users.localites_id','localites.id')
        ->orderByDesc('created_at')
        ->get();
        $users =  $users->makeHidden(['password']);

        return view('pages.user.index', compact('users'));
    }

    /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function create($user_id=null)
    {
        if (auth()->guest()) {
            return redirect('/login');
        }

        $localites = Localite::all();
        $etats = ["actif","inactif"];
        $roles = Role::all();
        $user = null;
        if($user_id){
            $user = User::find($user_id);
        }
        return view('pages.user.new', [
            'localites' => $localites,
            'roles' => $roles,
            'user' => $user,
            'etats' => $etats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = request('user_id');

        if ($id != '' && $id != null) {

            request()->validate([
                'nom' => ['required'],
                'prenom' => ['required'],
                'role' => ['required'],
                'localite' => ['required'],
                'telephone' => ['required','numeric'],
                'etat' => ['required'],
                'email' => ['required', Rule::unique('users', 'email')->ignore($id)],

            ]);
            $user = User::findOrFail($id);

        } else {

            request()->validate([
                'nom' => ['required'],
                'prenom' => ['required'],
                'role' => ['required'],
                'localite' => ['required'],
                'telephone' => ['required','numeric'],
                'etat' => ['required'],
                'email' => ['required','email','unique:users,email'],

            ]);
            $user = new User();
            $password = Str::random(10);
            $user->password = bcrypt($password);
        }

        $user->nom = request('nom');
        $user->prenom = request('prenom');
        $user->roles_id = request('role');
        $user->email = request('email');
        $user->localites_id = request('localite');
        $user->telephone = request('telephone');
        $user->etat = request('etat');

         if ($user->save()) {
             if ($id != '' && $id != null) {
                 flash()->success('Succès !', 'Utilisateur ajouté avec succès.');
                 return redirect("user");

             }else{
                 flash()->success('Succès !', 'Utilisateur ajouté avec succès.');
                 $this->_sendNewMail("SOS SECURITE", "Voici votre nouveau mot de passe pour accéder a l'espace SOS SECURITE : " . $password, [$user->email]);
                 return redirect("user");

             }
        }
        return back();
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->guest()) {
            return redirect('/login');
        }

        $user = User::findOrFail($id);


        return view('pages.user.show', [
          'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
  {

  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id){
            $user = User::findOrFail($id);
            if ($user->forceDelete()) {
                return "done";
            } else {
                return "fail";
            }
        }
    }

    public function reset(Request $request)
    {
        $user = User::findOrFail(request('id'));
        $user->password = bcrypt("azerty");
        if ($user->save()) {
            flash()->success('Succès !', 'Mot de passe de l\'utilisateur réinitialisé avec succès.');
            return "ok";
        }
        return "nnok";
    }

    public function gerer()
    {
        if (auth()->guest()) {
        return redirect('/login');
        }
        $users = User::select('photo','id','matricule','prenom','nom','sexe','type','interphone')->where('active','=',1)->orderByDesc('id')->get();
        $homme = User::where('active','=',1)->where('sexe','=','Homme')->count();
        $femme = User::where('active','=',1)->where('sexe','=','Femme')->count();
        $activite = User::where('active','=',1)->count();
        $users->map(function($item){
            $item->photo = json_decode($item->photo);
        });

        return view('/pages/user/lister', compact('users','homme','femme','activite'));
    }

    public function password(Request $request)
    {
        if (auth()->guest()) {
            return redirect('/login');
        }
        //method old password validation
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, current($parameters));
        }, 'Ancien mot de passe incorrect.');

        $validator = Validator::make(request()->all(), [
            'ancien_mot_de_passe' => 'required|old_password:' . auth()->user()->password,
            'password' => ['required', 'confirmed', 'min:4'],
            'password_confirmation' => ['required'],
        ]);

        if($validator->fails()) {
            return redirect()->route('user.compte')->withErrors($validator);
        }

        $update = auth()->user()->update([
            'password' => bcrypt(request('password'))
        ]);

        if ($update) {
            flash()->success('Succès !', 'Mot de passe modifié avec succès.');
            return redirect()->route('user.compte');
        }

        return redirect()->route('user.compte')->withErrors($validator);
    }

    // Login
    public function login(Request $request){

        //verification
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }
        return view('pages.user.login',);
    }

    //deconnexion
    public function deconnexion(){
        if (auth()->guest()) {
            return redirect('/login');
        }

        auth()->logout();
        return redirect('/');
    }

    //Connexion
    public function connexion(Request $request){
        //validation
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // auth attempt laravel
        $resultat = auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
            'etat' => "actif",
        ]);



        if ($resultat) {
            $user = User::find(auth()->user()->id);
            $user->last_login_at =Carbon::now()->toDateTimeString();
            $user->save();
            return redirect()->route('dashboard.index');
        }

        return back()->withInput()->withErrors([
            'login' => 'E-mail ou mot de passe incorrect.',
        ]);
    }

    //mon compte
    public function compte()
    {
        if (auth()->guest()) {
            return redirect('/login');
        }

        return view('pages.user.account');
    }

    public function motDePasseForm(){
        //verification
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }
        return view('pages.user.oublie');
    }

    public function changePassword(Request $request,$id){
        $user = User::findOrFail($id);

        return view('pages.user.changepassword',compact('user'));
    }

    public function changePasswordStore(Request $request,$id){

        $user = User::findOrFail($id);


        request()->validate([
            'ancien_mot_de_passe' => ['required'],
            'password' => ['required', 'confirmed', 'min:4'],
            'password_confirmation' => ['required'],
        ]);


        if(!Hash::check($request->ancien_mot_de_passe,$user->password)){
            return back()->withInput()->withErrors([
                'ancien_mot_de_passe' => 'La valeur de ce champs est incorrect.',
            ]);
        }

        if(Hash::check($request->password,$user->password)){
            return back()->withInput()->withErrors([
                "password" => "Le nouveau mot de passe doit être different de l'actuel mot de passe",
            ]);
        }

        $user->password = bcrypt($request->password);
        if($user->save()){

        }

        return redirect()->intended('/');
    }

    public function motDePasseSend(Request $request){
        //verification
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }

        $user = User::where('email', request('email'))->where('etat', 'actif')->first();

        if($user){
            $userPassword = UserPassword::create([
                'users_id' => $user->id,
                'statut' => 'cree',
                'expired_at' => Carbon::now()->addHour()->format('Y-m-d H:i:s'),
                'token' => Str::random(50)

            ]);

            $this->_sendNewMail(
                    'RECUPERATION MOT DE PASSE',
                    "<p>Bonjour <strong>".$user->prenom." ".$user->nom."</strong>, <br>".
                    "une demande de réinitialisation du mot de passe a été reçue de votre compte.<br>".
                    "Veuillez utiliser ce lien pour réinitialiser votre mot de passe<br><br>".
                    route('mot_de_passe.lien', $userPassword->token)."<br><br>".
                    "<strong>Note :</strong> Ce lien est valable pendant une heure à partir du moment où il vous a été envoyé et ne peut être utilisé qu'une seule fois pour changer votre mot de passe.<br>".
                    "</p>",
                    [$user->email]
                );
        }
        $message = "E-mail envoyé avec succès.";
        return view('pages.user.oublie', compact('message'));
    }

    public function motDePasseLien(Request $request){
        //verification
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }
        $userPassword = UserPassword::where('token', request('token'))
                                    ->where('statut', 'cree')
                                    ->whereDate('expired_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))
                                    ->first();

        if(!$userPassword){
            abort(404, 'Page not found.');
        }
        return view('pages.user.password', compact('userPassword'));

    }
    public function motDePasseChange(Request $request){
        //verification
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }
        request()->validate([
            'password' => ['required', 'confirmed', 'min:4'],
            'password_confirmation' => ['required'],
        ]);

        $user = User::findOrFail(request('user_id'));
        $user->password = bcrypt(request('password'));
        if($user->save()) {
            $userPassword = UserPassword::findOrFail(request('id'));
            $userPassword->statut = "traite";
            $userPassword->save();

           // $message = "E-mail envoyé avec succès.";
            flash()->success('Succès !', 'Mot de passe modifié avec succès.');
            return redirect()->route('login');

        }
        return back();
    }

    public function success(){
       // verification
        if (auth()->check()) {
            return redirect()->route('/');
        }

        return view('pages.user.success');
    }
    public function pagination(Request $request)
    {

                $offset     =   $request->offset ;
                $limit      =   $request->limit ;
                $order_val  =   $request->order;
                $sort       =   $request->sort;
                $search     =   $request->search;

                if($sort){

                    $test =   User::select(
                                DB::raw('users.*'),
                                DB::raw('roles.libelle as role'),
                                DB::raw('localites.nom as localite'),
                                )
                                ->leftJoin('roles','users.roles_id','roles.id')
                                ->leftJoin('localites','users.localites_id','localites.id')
                                ->skip($offset)
                                ->take($limit)
                                ->orderBy($sort,$order_val)
                                ->get();
                }elseif($search){

                     $test =   User::select(
                                DB::raw('users.*'),
                                DB::raw('roles.libelle as role'),
                                DB::raw('localites.nom as localite'),
                                )
                                ->leftJoin('roles','users.roles_id','roles.id')
                                ->leftJoin('localites','users.localites_id','localites.id')
                                 ->where('nom','LIKE',"%{$search}%")
                                 ->orWhere('prenom','LIKE',"%{$search}%")
                                 ->orWhere('email','LIKE',"%{$search}%")
                                 ->skip($offset)
                                 ->take($limit)
                                 ->orderBy("created_at",$order_val)
                                 ->get();
                 }
                else{

                    $test =  User::select(
                        DB::raw('users.*'),
                        DB::raw('roles.libelle as role'),
                        DB::raw('localites.nom as localite'),
                        )
                     ->leftJoin('roles','users.roles_id','roles.id')
                     ->leftJoin('localites','users.localites_id','localites.id')
                     ->get();
                }


                $data = [ "total"=> User::where('nom','LIKE',"%{$search}%")
                                        ->orWhere('prenom','LIKE',"%{$search}%")
                                        ->orWhere('email','LIKE',"%{$search}%")
                                        ->count(),
                        "totalNotFiltered"=> User::all()->count(),
                        "rows"=> $test];

                return $data;
    }

}

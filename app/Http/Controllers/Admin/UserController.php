<?php

namespace OrlandoLibardi\UserCms\app\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;


class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request) {

        
        //pegar o id role
        $user = Auth::user();
        $role_model = DB::table('model_has_roles')->where('model_id', $user->id)->first();
        $role_id = $role_model->role_id;
        //fazer um verificação manual de propriedades
        if($role_id == 4){
            
            //super administrador (visualiza todos)
            $user_role = DB::table('model_has_roles')->get();
            $roles = Role::pluck('name','name')->all();
            
        }else
        if($role_id == 3){
            //administrador visualiza (administradore, colaboradores, e visitantes)
            $user_role = DB::table('model_has_roles')
                        ->where('role_id', "!=", 18)
                        ->get();
            $roles = Role::where('id', '!=', 18)->pluck('name','name')->all();

        }else{
            //visitante e Colaborador (visualiza somente ele mesmo)
            return redirect()->route('users.edit', [ 'id' => $user->id ]);
        }

        $user_role = array_pluck($user_role, 'model_id', 'model_id');
        $data = User::whereIn('id', $user_role)->orderBy('name','ASC')->get();

        $user  = false;
        return view('viewUserCms::users.index',compact('data', 'roles', 'user'));        
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {

    }


    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        $validator = validator($request->all(),
        [ 'nome' => 'required',
        'email' => 'required|email|unique:users,email',
        'senha' => 'required',
        'permissoes' => 'required'] );

        if($validator->fails()) {

            return response()->json(array( 'message' => 'Os dados fornecidos são inválidos.', 'status'  =>  'error',  'errors'   =>  $validator->errors()->all() ), 422);

        }
        $defaults = ['name' => 'nome',  'email' => 'email', 'password' => 'senha', 'roles' => 'permissoes'];
        $input = $request->all();
        $final = [];
        foreach($defaults as $k=>$v){
            $final[$k] = $input[$v];
        }

        $final['password'] = Hash::make($final['password']);
        $user = User::create($final);
        $user->assignRole($request->input('permissoes'));

        return response()->json(array( 'message' => 'Criado com sucesso.', 'status'  =>  'success' ), 201);
    }


    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $user = User::find($id);
        return view('viewUserCms::users.show', compact('user'));
    }


    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user = Auth::user();
        $role_model = DB::table('model_has_roles')->where('model_id', $user->id)->first();
        $role_id = $role_model->role_id;

        if($role_id == 18){
            //super administrador (visualiza todos)
            $user_role = DB::table('model_has_roles')
                             ->get();
            $roles = Role::pluck('name','name')->all();

        }else
        if($role_id == 17){
            //administrador visualiza (administradore, colaboradores, e visitantes)
            $user_role = DB::table('model_has_roles')
                             ->where('role_id', "!=", 18)
                             ->get();
            $roles = Role::where('id', '!=', 18)->pluck('name','name')->all();

        }else{
            $roles = Role::where('id', '=', $role_id)->pluck('name','name')->all();
        }


        $user = User::find($id);
        $userRole = $user->roles->pluck('name','name')->all();
        return view('viewUserCms::users.index',compact('user','roles','userRole'));
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
        $validator = validator($request->all(),
        [ 'nome' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'permissoes' => 'required'] );

        if($validator->fails())
        return response()->json(array( 'message' => 'Os dados fornecidos são inválidos.', 'status'  =>  'error',  'errors'   =>  $validator->errors()->all() ), 422);

        $defaults = ['name' => 'nome',  'email' => 'email', 'password' => 'senha', 'roles' => 'permissoes'];
        $input    = $request->all();
        $final    = [];

        foreach($defaults as $k=>$v){
            $final[$k] = $input[$v];
        }

        if(!empty($final['password'])){
            $final['password'] = Hash::make($final['password']);
        }else{
            $final = array_except($final,array('password'));
        }


        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user = User::find($id);
        $user->update($final);
        $user->assignRole($request->input('permissoes'));

        return response()->json(array( 'message' => 'Editado com sucesso!', 'status'  =>  'success' ), 201);

    }


    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request)
    {

        $validator = validator($request->all(), [ 'id' => 'required'] );

        if($validator->fails()) return response()->json(array( 'message' => 'Os dados fornecidos são inválidos.', 'status'  =>  'error',  'errors'   =>  $validator->errors()->all() ), 422);


        $ids = json_decode($request->input('id'));

        foreach($ids as $id){

            if(is_numeric($id)) User::find($id)->delete();

        }
        return response()->json(array( 'message' => 'Removidos com sucesso!', 'status'  =>  'success'), 201);
    }
}

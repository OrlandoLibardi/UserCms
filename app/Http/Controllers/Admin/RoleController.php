<?php

namespace OrlandoLibardi\UserCms\app\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{

    /*public function __construct() {
        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }*/

/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
    $roles = Role::orderBy('name','ASC')->get();
    $role  = false;
    $permission = Permission::get();
    $permission_list = [];
    //trabalhando resultados para list
    foreach($roles as $r){
        $results = DB::table('role_has_permissions')
        ->where('role_id', $r->id)
        ->join('permissions', 'permissions.id', 'role_has_permissions.permission_id')
        ->get();
        $permission_list[$r->id] = $results;
    }



    return view('viewUserCms::roles.index', compact('roles', 'permission', 'role', 'permission_list'));
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
    [ 'nome' => 'required|unique:roles,name',
    'permissao' => 'required'] );

    if($validator->fails()) {

        return response()->json(array( 'message' => 'Os dados fornecidos são inválidos.', 'status'  =>  'error',  'errors'   =>  $validator->errors()->all() ), 422);

    }

    $role = Role::create(['name' => $request->input('nome')]);
    $role->syncPermissions($request->input('permissao'));

    return response()->json(array( 'message' => 'Criado com sucesso.', 'status'  =>  'success' ), 201);
}


/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    $role = Role::find($id);
    $permission = Permission::get();
    $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
    ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    ->all();


    return view('viewUserCms::roles.index',compact('role','permission','rolePermissions'));
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
    [ 'nome' => 'required|unique:roles,name,'.$id,
    'permissao' => 'required'] );

    if($validator->fails()) {

        return response()->json(array( 'message' => 'Os dados fornecidos são inválidos.', 'status'  =>  'error',  'errors'   =>  $validator->errors()->all() ), 422);

    }

    $role = Role::find($id);
    $role->name = $request->input('nome');
    $role->save();


    $role->syncPermissions($request->input('permissao'));

    return response()->json(array( 'message' => 'Editado com sucesso.', 'status'  =>  'success' ), 201);

}



/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request, $id)
{
    $validator = validator($request->all(), [ 'id' => 'required'] );

    if($validator->fails()) {

        return response()->json(array( 'message' => 'Os dados fornecidos são inválidos.'.$request->input('id'), 'status'  =>  'error',  'errors'   =>  $validator->errors()->all() ), 422);

    }

    $ids = json_decode($request->input('id'));
    $msg = "";
    foreach($ids as $id){
        if(is_numeric($id)){
            DB::table("roles")->where('id', $id)->delete();
        }
    }
    return response()->json(array( 'message' => 'Removidos com sucesso!', 'status'  =>  'success'), 201);

}
}

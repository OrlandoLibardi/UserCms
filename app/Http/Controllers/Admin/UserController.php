<?php

namespace OrlandoLibardi\UserCms\app\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\User;
use OrlandoLibardi\UserCms\app\Http\Requests\UserRequest;
use OrlandoLibardi\UserCms\app\Http\Requests\UserUpdateRequest;
use OrlandoLibardi\UserCms\app\Http\Requests\UserDeleteRequest;
use OrlandoLibardi\UserCms\app\ServiceUser;
use Auth;


class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request) 
    {        
        $nUser = User::roleId(Auth::user()->id);
        if($nUser->role_id <= 2){
            return redirect()->route('users.edit', [ 'id' => $nUser->id ]);
        }
        $userRole = ServiceUser::getUserRoles($nUser->role_id);
        $roles     = ServiceUser::getRoles($nUser->role_id);
        $data      = ServiceUser::Users($userRole);
        return view('admin.users.index',compact('data', 'roles'));
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
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $user->assignRole($request->role);
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
        return view('admin.users.show', compact('user'));
    }


    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        
        $nUser = User::roleId(Auth::user()->id);
        $userRole = ServiceUser::getUserRoles($nUser->role_id);
        $roles     = ServiceUser::getRoles($nUser->role_id);
        $user      = User::find($id);
        return view('admin.users.index',compact('user','roles','userRole'));

    }


    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UserUpdateRequest $request, $id)
    {
        
        ServiceUser::DeleteModelHasRole($id);
        $all = ServiceUser::setParamsUpdateUser( $request->all() ) ;
        $user = User::find($id);
        $user->update(  $all );
        $user->assignRole($request->role);
        return response()->json(array( 'message' => 'Editado com sucesso!', 'status'  =>  'success' ), 201);

    }


    /**
    * Remove the specified resource from storage.
    *
    * @param  array  $ids
    */
    public function destroy(UserDeleteRequest $request)
    {
        ServiceUser::delete($request->id);
        return response()->json(array( 'message' => 'Removidos com sucesso!', 'status'  =>  'success'), 201);
    }
}
